<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Hourlydata;
use DataTables;

class WeatherController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Hourlydata::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('city_name', function($row){
                        return $row->city ? $row->city->name : '';
                    })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('city') != '') {
                            $instance->where('city_id', $request->get('city'));
                        }
                        if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('timezone', 'LIKE', "%$search%")
                                ->orWhere('weather_title', 'LIKE', "%$search%")
                                ->orWhere('weather_description', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['city_name'])
                    ->make(true);
        }

        $cities = City::all();
        return view('list')->with('cities', $cities);
    }
}

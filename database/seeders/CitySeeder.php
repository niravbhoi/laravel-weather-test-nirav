<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert(
            [
                [
                    'name' => 'Ahmedabad',
                    'country' => 'IN',
                    'lat' => 23.033333,
                    'lon' => 72.616669,
                ],
                [
                    'name' => 'Mumbai',
                    'country' => 'IN',
                    'lat' => 19.01441,
                    'lon' => 72.847939,
                ],
                [
                    'name' => 'Kolkata',
                    'country' => 'IN',
                    'lat' => 22.569719,
                    'lon' => 88.36972,
                ],
                [
                    'name' => 'London',
                    'country' => 'GB',
                    'lat' => 51.50853,
                    'lon' => -0.12574,
                ],
                [
                    'name' => 'Chennai',
                    'country' => 'IN',
                    'lat' => 13.08784,
                    'lon' => 80.278473,
                ]
            ]
        );
    }
}

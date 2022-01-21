<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\City;
use App\Models\Hourlydata;

class HourlyWeatherCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourlyweather:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will get weather data for cities';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $weather_app_key = env('WEATHER_APP_KEY', '');
        if($weather_app_key != ''){
            $cities = City::all();
            if(count($cities) > 0){
                foreach ($cities as $city) {
                    try {
                        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=".$city->lat."&lon=".$city->lon."&exclude=minutely,daily,alerts,hourly&appid=".$weather_app_key;
                        $response = Http::get($url);
                        if (!$response->successful()){
                            $response->throw();
                        }else{
                            $weatherData = $response->json();

                            $hourlydata = new Hourlydata();
                            $hourlydata->city_id = $city->id;
                            $hourlydata->timezone = $weatherData['timezone'] ?? '';
                            $hourlydata->timezone_offset = $weatherData['timezone_offset'] ?? 0;

                            $currentdata = $weatherData['current'];
                            $hourlydata->dt = $currentdata['dt'] ?? 0;
                            $hourlydata->sunrise = $currentdata['sunrise'] ?? 0;
                            $hourlydata->sunset = $currentdata['sunset'] ?? 0;
                            $hourlydata->temp = $currentdata['temp'] ?? 0;
                            $hourlydata->feels_like = $currentdata['feels_like'] ?? 0;
                            $hourlydata->pressure = $currentdata['pressure'] ?? 0;
                            $hourlydata->humidity = $currentdata['humidity'] ?? 0;
                            $hourlydata->uvi = $currentdata['uvi'] ?? 0;
                            $hourlydata->clouds = $currentdata['clouds'] ?? 0;
                            $hourlydata->visibility = $currentdata['visibility'] ?? 0;
                            $hourlydata->wind_speed = $currentdata['wind_speed'] ?? 0;
                            $hourlydata->wind_deg = $currentdata['wind_deg'] ?? 0;
                            $hourlydata->wind_gust = $currentdata['wind_gust'] ?? 0;

                            $currentWeatherData = $currentdata['weather'];
                            $hourlydata->weather_title = $currentWeatherData[0]['main'] ?? '';
                            $hourlydata->weather_description = $currentWeatherData[0]['description'] ?? '';
                            $hourlydata->weather_icon = $currentWeatherData[0]['icon'] ?? '';

                            $hourlydata->save();
                            \Log::info("Cron is working fine!");
                            $this->info('Cron Cummand Run successfully!');
                        }
                    } catch (\Exception $e){
                        \Log::info("Something went wrong!");
                        $this->info('Something went wrong!');
                    }
                }
            }else{
                \Log::info("City data not found run seeder first!");
                $this->info('City data not found run seeder first!');
            }
        }else{
            \Log::info("Missing WEATHER_APP_KEY in env");
            $this->info('Missing WEATHER_APP_KEY in env');
        }
    }
}

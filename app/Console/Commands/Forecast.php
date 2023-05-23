<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use App\Models\City;

class Forecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast {cities?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays weather forecast data in table format';

    public $cities = [];
    public $forecastData = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $headers = ['City', 'Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'];
        $this->cities = $this->argument('cities');

        if (!$this->cities) {
            $name = $this->ask('Please provide atleast 1 city name');

            array_push($this->cities, $name);
        }

        $this->fetchForecast();

        $this->table($headers, $this->forecastData);
    }

    public function fetchForecast()
    {
        foreach ($this->cities as $city) {
            $this->info($city);

            $data = City::where('name', '=', $city)->first();

            if ($data) {
                $weatherBitURL = "https://api.weatherbit.io/v2.0/forecast/daily?days=5&key=cede2f910b314d9d8cbcf095e0e4304f&country=AU&city_id=";

                $response = Http::get($weatherBitURL . $data->city_id);

                $cityData = [
                    $data->name,
                ];

                foreach ($response["data"] as $r) {
                    $avg = ($r["max_temp"] + $r["min_temp"]) / 2;
                    $max = $r["max_temp"];
                    $min = $r["min_temp"];

                    array_push($cityData, "Avg {$avg}, Max {$max}, Low {$min}");
                }

                array_push($this->forecastData, $cityData);
            } else {
                array_push($this->forecastData, ['Invalid', '', '', '', '', '']);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\City;

class WeatherController extends Controller
{
    
    public function cities()
    {
        $cities = City::all();

        return $cities;
    }

    public function forecast(Request $request)
    {
        $weatherBitURL = "https://api.weatherbit.io/v2.0/forecast/daily?days=5&key=cede2f910b314d9d8cbcf095e0e4304f&country=AU&city_id=";

        $response = Http::get($weatherBitURL . $request->input('city_id'));

        return $response;
    }

}

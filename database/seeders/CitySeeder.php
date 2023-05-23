<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Brisbane', 'postcode' => '4300', 'city_id' => '2174003'],
            ['name' => 'Sunshine Coast', 'postcode' => '4551', 'city_id' => '2172710'],
            ['name' => 'Gold Coast', 'postcode' => '4217', 'city_id' => '2165087'],
        ];

        City::insert($data);
    }
}

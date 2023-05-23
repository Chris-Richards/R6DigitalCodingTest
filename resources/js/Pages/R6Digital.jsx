import GuestLayout from '@/Layouts/GuestLayout';
import Forecast from '@/Components/R6/Forecast';
import { Head } from '@inertiajs/react';
import { useEffect, useState } from 'react';

export default function R6Digital() {

    const [cities, setCities] = useState([]);
    const [currentCity, setCurrentCity] = useState(2174003); // Brisbane default forecast to show
    const [forecastData, setForecastData] = useState([]);

    const fetchForecast = (city_id) => {
        const token = document.head.querySelector('meta[name="csrf-token"]').content;
        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', "X-CSRF-TOKEN": token },
            body: JSON.stringify({'city_id': city_id})
        };
        fetch(route('weather.forecast'), requestOptions)
            .then(response => response.json())
            .then(data => setForecastData(data));
    }

    const fetchCities = () => {
        const token = document.head.querySelector('meta[name="csrf-token"]').content;
        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', "X-CSRF-TOKEN": token },
        };
        fetch(route('weather.cities'), requestOptions)
            .then(response => response.json())
            .then(data => setCities(data));
    }

    useEffect(() => {
        fetchCities()
        fetchForecast(currentCity)
    }, []);

    return (
        <GuestLayout>
            <Head title="R6 Digital" />

            <div className="">
                <select 
                    className="w-full border-2 border-slate-500 rounded p-2"
                    onChange={e => fetchForecast(e.target.value)}
                >
                {cities.map( (city) => (
                    <option key={city.id} value={city.city_id}>{city.name}</option>
                ) )}
                </select>

                <div className="mt-4 bg-slate-300 p-4 rounded">
                    <h3 className="font-bold text-2xl mb-2 text-center">{forecastData.city_name} 5 Day Forecast</h3>
                    {forecastData.data?.map( (data, index) => (
                        <Forecast key={index} props={data} day={index += 1}></Forecast>
                    ) )}
                </div>
            </div>
        </GuestLayout>
    );
}

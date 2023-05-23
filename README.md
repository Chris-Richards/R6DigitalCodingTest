# R6DigitalCodingTest
 
Clone this repo to your system. Create a .env file using the example provided and fill in your local MySQL credentials. Then proceed with the following install process.

```
composer install
```
```
npm install
```
```
php artisan migrate
```
```
php artisan db:seed --class=CitySeeder
```
Open a second tab in your console and proceed with php artisan serve and npm run dev in each tab.
Tab 1
```
php artisan serve
```
Tab 2
```
npm run dev
```
Open localhost:8000 to view application


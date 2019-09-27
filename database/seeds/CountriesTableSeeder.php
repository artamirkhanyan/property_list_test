<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [ 'name' => 'Thailand' ],
            [ 'name' => 'Cambodia' ]
        ];

        Country::insert($countries);
    }
}

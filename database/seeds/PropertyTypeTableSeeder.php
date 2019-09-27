<?php

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_types = [
            [ 'name' => 'Condo' ],
            [ 'name' => 'House' ],
            [ 'name' => 'Land' ],
        ];

        PropertyType::insert($property_types);
    }
}

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    $bedroom_number = $faker->numberBetween(1,10);
    $bedroom_number = ($bedroom_number == 2) ? 1 : $bedroom_number;
    $bathroom_number = round($bedroom_number/ 2);

    $property_type = App\Models\PropertyType::where('name', '!=', 'Condo')->get()->random();
    $status = App\Models\Status::all()->random();

    $region = App\Models\Region::all()->random();
    $for_rent = $faker->randomElement([ 1, 0 ]);

    if($for_rent && $status->name === 'Inactive' && $region->name === 'Region 3' && $property_type->name === 'House') {
        $region = 1;
    } else {
        $region = $region->id;
    }

    return [
        'title' => $faker->word,
        'description' => $faker->text(100),
        'bedroom' => $bedroom_number,
        'bathroom' => $bathroom_number,
        'for_sale' => $faker->randomElement([ 1, 0 ]),
        'for_rent' => $for_rent,
        'project_id' => rand(2, 10000),
        'property_type_id' => $property_type->id,
        'status_id' => $status->id,
        'region_id' => $region,
    ];
});

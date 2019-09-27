<?php

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 10; $i++) {
            factory(Property::class, 10000)->create();
        }

        // Has only 1 project have 2,001 property
        Property::where('id', '>=', 1)
            ->where('id',  '<=', 2001)
            ->update(['project_id' => 1]);

        // Total active 2 bedroom condo for sale is 3,000 property
        Property::where('id', '>=', 2000)
            ->where('id', '<', 5000)
            ->update([
                'status_id' => 1,
                'for_sale' => 1,
                'bedroom' => 2,
                'property_type_id' => 1,
            ]);
    }
}

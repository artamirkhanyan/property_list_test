<?php

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'name' => 'Region 1',
                'country_id' => 1
            ],
            [
                'name' => 'Region 2',
                'country_id' => 1
            ],
            [
                'name' => 'Region 7',
                'country_id' => 2
            ],
            [
                'name' => 'Region 3',
                'country_id' => 2
            ]
        ];

        Region::insert($regions);
    }
}

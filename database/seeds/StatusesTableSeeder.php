<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [ 'name' => 'Active' ],
            [ 'name' => 'Inactive' ],
            [ 'name' => 'Draft' ],
        ];

        Status::insert($statuses);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertiesListTest extends TestCase
{
    /**
     * A basic feature test.
     *
     * @return void
     */
    public function testDatatableData()
    {

        // datatable default params
        $params = [
            'draw' => 1,
            'search' => [
                'value'=>'',
                'regex'=>false
            ],
            'order' => [
                [
                    'column'=>0,
                    'dir'=>'asc'
                ]
            ],
            'start'=> 0,
            'length'=> 20,
        ];

        $response = $this->get('/properties/list?'.http_build_query($params));

        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                "data",
                "draw",
                "recordsFiltered",
                "recordsTotal"
            ]
        );
    }
}

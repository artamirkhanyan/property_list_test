<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Property;
use App\Http\Resources\Property as PropertyResource;

class PropertiesController extends Controller
{
    public static $columns = [
        0  => "title" ,
        1  => "description" ,
        2  => "bedroom" ,
        3  => "bathroom" ,
        4  => "property_type" ,
        5  => "status" ,
        6  => "for_sale" ,
        7  => "for_rent" ,
        8  => "project_name" ,
        9 => "country" ,
    ];


    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function propertiesList(Request $request)
    {
        $request->validate([
            'draw' => 'required|integer',
            'search' => 'required|array',
            'order'  => 'required|array',
            'start' => 'required|integer',
            'length' => 'required|integer'
        ]);

        $offset = $request->start;
        $limit  = $request->length;
        $search = $request->search['value'];
        $order_column = self::$columns[$request->order[0]['column']];
        $order_dir = $request->order[0]['dir'];

        $properties = Property::
            leftJoin('property_types', 'properties.property_type_id', '=', 'property_types.id')
            ->leftJoin('projects', 'properties.project_id', '=', 'projects.id')
            ->leftJoin('regions', 'properties.region_id', '=', 'regions.id')
            ->leftJoin('countries', 'regions.country_id', '=', 'countries.id')
            ->leftJoin('statuses', 'properties.status_id', '=', 'statuses.id')
            ->selectRaw('properties.*, property_types.name as property_types_sort_name, statuses.name as statuses_sort_name, projects.name as projects_sort_name, countries.name as countries_sort_name' )
            ->when($order_column == 'property_type', function ($query) use ($order_dir) {
                $query->orderBy('property_types_sort_name', $order_dir);
            })
            ->when($order_column == 'project_name', function ($query) use ($order_dir) {
                $query->orderBy('projects_sort_name', $order_dir);
            })
            ->when($order_column == 'country', function ($query) use ($order_dir) {
                $query->orderBy('countries_sort_name', $order_dir);
            })
            ->when($order_column == 'status', function ($query) use ($order_dir) {
                $query->orderBy('statuses_sort_name', $order_dir);
            })            
            ->when(!in_array($order_column, ['status', 'country', 'project_name', 'property_type']), function ($query) use ($order_dir, $order_column) {
                $query->orderBy($order_column, $order_dir);
            })
            ->when(!empty($search), function ($query) use ($search) {
                $query->where(function ($query) use($search){
                    $query->orWhere('description', 'like', '%'.$search.'%');
                    $query->orWhere('bedroom', 'like', '%'.$search.'%');
                    $query->orWhere('bathroom', 'like', '%'.$search.'%');
                    $query->orWhere('title', 'like', '%'.$search.'%');
                    $query->orWhere('property_types.name', 'like', '%'.$search.'%');
                    $query->orWhere('countries.name', 'like', '%'.$search.'%');
                    $query->orWhere('statuses.name', 'like', '%'.$search.'%');
                    $query->orWhere('projects.name', 'like', '%'.$search.'%');
                });
            });
        $propertiesCount = $properties->count();

        $properties = $properties
            ->with([ 'project', 'status', 'type', 'region.country'])
            ->offset($offset)
            ->limit($limit)
            ->get();

        $response = [
            'data' => PropertyResource::collection($properties),
            'draw' => (int)$request->draw,
            'recordsTotal' => Property::count(),
            'recordsFiltered' => $propertiesCount,
        ];

        return response()->json($response, 200);
    }
}

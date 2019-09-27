<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title',
        'description',
        'bedroom',
        'bathroom',
        'for_sale',
        'for_rent',
        'project_id',
        'property_type_id',
        'status_id',
        'region_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}

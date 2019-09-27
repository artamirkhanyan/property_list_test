<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Property extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'bedroom' => $this->bedroom,
            'bathroom' => $this->bathroom,
            'for_sale' => $this->for_sale,
            'for_rent' => $this->for_rent,
            'project_name' => $this->when($this->relationLoaded('project'), function() {
                return $this->project->name;
            }),
            'status' => $this->when($this->relationLoaded('status'), function() {
                return $this->status->name;
            }),
            'property_type' => $this->when($this->relationLoaded('type'), function() {
                return $this->type->name;
            }),
            'country' => $this->when($this->relationLoaded('region'), function() {
                return $this->region->country->name;
            })
        ];
    }
}

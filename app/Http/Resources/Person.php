<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Person extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'familyName' => $this->family_name,
            'status' => $this->status,
            'party' => $this->party,
            'life' => $this->life,
            'lifeSource' => $this->life_source,
            'role' => $this->status,
            'photo' => null,
            'email' => $this->email,
            'phone' => $this->phone,
            'fax' => null,
            'location' => \App\Location::find([$this->location])->first(),
            'committeeList' => Organization::collection($this->whenLoaded('organizations')),
            'files' => null,
        ];
    }
}

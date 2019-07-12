<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
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
            "room" => $this->room,
            'StreetAddress' => $this->streetAddress,
            'postalCode' => $this->postalCode,
            'city' => $this->locality,
            'district' => $this->subLocality,
            'description' => $this->description,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Conference extends JsonResource
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
            'title' => $this->title,
            'location' => $this->location,
            'date' => $this->date->toW3Cstring()
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Agendum extends JsonResource
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
            'number' => $this->number,
            'name' => $this->name,
            'resolutionText' => $this->resolutionText,
            'result' => $this->result,
            'order' => $this->order,
            'public' => $this->public,
            'start' => $this->start,
            'end' => $this->end,
        ];
    }
}

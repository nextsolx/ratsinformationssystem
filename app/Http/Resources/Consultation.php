<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Consultation extends JsonResource
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
            'finished' => (boolean) $this->authoritative,
            'role' => $this->role,
            'meeting' => new Meeting($this->meeting),
            'agendum' => new Agendum($this->agendum),
        ];
    }
}

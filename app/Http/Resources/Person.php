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

        $org = $this->organizations->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'party' => $this->party,
            'life' => $this->life,
            'lifeSource' => $this->lifeSource,
            'role' => $org ? $org->pivot->role : null,
            'photo' => 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png'
        ];
    }
}

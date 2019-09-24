<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Paper extends JsonResource
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
            'reference' => $this->reference,
            'paper_type' => $this->paperType,
            'files' => File::collection($this->files),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class File extends JsonResource
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
            'fileName' => $this->file_name,
            'accessUrl' => $this->access_url,
            'downloadUrl' => $this->download_url,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Topic extends JsonResource
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
            'text' => $this->text(),
            'reference' => $this->reference,
            'type' => $this->paper_type,
            'result' => $this->result(),
            'date' => $this->date,
            'modified' => $this->modified,
            'finished' => $this->isFinished(),
            'newTopic' => $this->isNew(),
            'location' => Location::collection($this->locations),
            'meetings' => Meeting::collection($this->meetings),
            'process' => Consultation::collection($this->consultations),
            'files' => File::collection($this->files),
        ];
    }
}

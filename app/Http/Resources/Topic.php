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
            'reference' => $this->reference,
            'type' => $this->paper_type,
            'result' => $this->result(),
            'date' => $this->date->toDateTimeString() ?? null,
            'modified' => $this->modified,
            'location' => Location::collection($this->locations),
            'solution' => 'Der Vorschlag der Verwaltung wurde ohne Änderungen beschlossen.',
            'whatNext' => 'Die Politik beauftragt die Verwaltung mit der Umsetzung ihrer Entscheidung.',
            'finished' => $this->isFinished(),
            'newTopic' => $this->isNew(),
        ];
    }
}

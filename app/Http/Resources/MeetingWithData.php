<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingWithData extends JsonResource
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
            'title' => $this->name,
            'dateFrom' => $this->start,
            'dateTill' => $this->end,
            'agendaCount' => $this->agendaCount(),
            'peopleCount' => $this->peopleCount(),
            'fileCount' => $this->fileCount(),
            'location' => new Location($this->location),
            'agenda' => new AgendumCollection($this->agenda),
            'organizations' => Organization::collection($this->organizations),
            'people' => Person::collection($this->people()),
            'files' => File::collection($this->files),
        ];
    }
}

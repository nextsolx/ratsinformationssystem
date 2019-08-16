<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Organization extends JsonResource
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
            'shortName' => $this->shortName,
            'info' => 'INFO',
            'organizationType' => $this->organizationType,
            'classification' => $this->classification,
            'memberCount' => $this->peopleCount(),
            'nextMeetingDate' => $this->nextMeetingDate(),
            'members' => Person::collection($this->whenLoaded('people')),
            'meetings' => Meeting::collection($this->whenLoaded('meetings')),
        ];
    }
}

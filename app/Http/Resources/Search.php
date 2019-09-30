<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Search extends JsonResource
{
    public function __construct(
        $people,
        $locations,
        $papers)
    {
        $this->people = $people;
        $this->locations = $locations;
        $this->papers = $papers;
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'people' => Person::collection($this->people),
            'locations' => Location::collection($this->locations),
            'topics' => TopicWithData::collection($this->papers),
        ];
    }
}

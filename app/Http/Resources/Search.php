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
            'people' => [
                'data' => Person::collection($this->people),
                'links' => Person::collection($this->people)->toResponse($request)->getData()->links,
                'meta' =>Person::collection($this->people)->toResponse($request)->getData()->meta,
            ],
            'locations' => [
                'data' => Location::collection($this->locations),
                'links' => Location::collection($this->locations)->toResponse($request)->getData()->links,
                'meta' => Location::collection($this->locations)->toResponse($request)->getData()->meta,
            ],
            'topics' => [
                'data' => Topic::collection($this->papers),
                'links' => Topic::collection($this->papers)->toResponse($request)->getData()->links,
                'meta' => Topic::collection($this->papers)->toResponse($request)->getData()->meta,
            ],
        ];
    }
}

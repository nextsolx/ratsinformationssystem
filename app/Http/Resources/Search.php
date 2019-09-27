<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Search extends JsonResource
{
    public function __construct(
        $meetings,
        $people,
        $organizations,
        $files,
        $locations,
        $papers)
    {
        $this->meetings = $meetings;
        $this->people = $people;
        $this->organizations = $organizations;
        $this->files = $files;
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
            'meetings' => $this->meetings,
            'people' => $this->people,
            'organizations' => $this->organizations,
            'files' => $this->files,
            'locations' => $this->locations,
            'papers' => $this->papers,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class AgendumCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
             $this->collection->groupBy(function($item) {
                  return Str::before($item->number, '.');
                })->map(function ($group) {
                    return $group->map(function($agendum) {
                        return [
                            'id' => $agendum->id,
                            'number' => $agendum->number,
                            'name' => $agendum->name,
                            'resolutionText' => $agendum->resolution_text,
                            'result' => $agendum->result,
                            'order' => $agendum->order,
                            'public' => $agendum->public,
                            'start' => $agendum->start,
                            'end' => $agendum->end,
                            'hasTopic' => (boolean) $agendum->papers()->count(),
                        ];
                    });
                })
        ];
    }
}




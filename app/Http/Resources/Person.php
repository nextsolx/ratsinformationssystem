<?php

namespace App\Http\Resources;


use App\Membership;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class Person extends JsonResource
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

        $organizations = $this->organizations;

        $memberships = Membership::where('person_id', $this->id)
            ->orderBy(DB::raw('end_date IS NOT NULL, end_date'), 'desc')
            ->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'familyName' => $this->family_name,
            'status' => $this->status,
            'party' => $this->party,
            'life' => $this->life,
            'lifeSource' => $this->life_source,
            'role' => $organizations->first() ? $organizations->first()->pivot->role : null,
            'function' => $organizations->first() ? $organizations->first()->pivot->role : null,
            'photo' => 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png',
            'email' => $this->email,
            'phone' => $this->phone,
            'fax' => null,
            'location' => \App\Location::find([$this->location])->first(),
            'committeeList' => $organizations,
            'memberships' => $memberships,
            'files' => []
        ];
    }
}

<?php

namespace App;

use Illuminate\Support\Arr;

class Organization extends Model
{
    protected $fillable = [
        'id',
        'name',
        'short_name',
        'organization_type',
        'classification',
        'start_date',
        'end_date',
    ];

    public static function initialize(array $data)
    {
        $organization = parent::initialize($data);

        if ($parentUrl= Arr::get($data, 'subOrganizationOf')) {
            $organization->parent_id = self::extractIdFromUrl($parentUrl);

            $organization->save();
        }

        return $organization;
    }

    public function parent()
    {
        return $this->belongsTo(Organization::class, 'parent_id');
    }

    //Todo: Verify
    public function peopleCount()
    {
        return $this->membership ? count($this->membership) : 0;
    }
}

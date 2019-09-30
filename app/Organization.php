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
        'website',
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

    public function people()
    {
        return $this->belongsToMany(Person::class, 'memberships')
            ->using(Membership::class);
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function peopleCount()
    {

        return $this->memberships()->count();
    }

    public function nextMeetingDate()
    {
        $nextMeeting = $this->nextMeeting();
        return $nextMeeting ? $nextMeeting->start : null;
    }
    public function nextMeeting()
    {
        return $this->meetings()->orderBy('start', 'DESC')->first();
    }
}

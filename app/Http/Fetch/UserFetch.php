<?php

namespace App\Http\Fetch;

use App\Models\Group;
use App\Models\Office;
use App\Models\User;

class UserFetch
{
    protected $user;
    protected $group;
    protected $office;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(User $user, Group $group, Office $office)
    {
        $this->user = $user;
        $this->group = $group;
        $this->office = $office;
    }

    /**
     * Handles querying of user model
     * 
     * @param array $params
     * @return mixed $user
     */
    public function execute($params)
    {
        $this->user = $this->user->whereNotIn('id', [auth()->user()->id])
                    ->whereLike('username', $params['username'])
                    ->orWhereLike('firstname', $params['name'])
                    ->orWhereLike('lastname', $params['name']);

        if($params['group'] && $params['group'] != 'null') {
            $groupId = $this->group->whereLike('name', $params['group'])->pluck('id')->toArray();
            $this->user = $this->user->whereIn('group_id', $groupId);
        }

        if($params['office'] && $params['office'] != 'null') {
            $officeId = $this->office->whereLike('name', $params['office'])->pluck('id')->toArray();
            $this->user = $this->user->whereIn('office_id', $officeId);
        }

        return $this->user->paginate(20);
    }
}
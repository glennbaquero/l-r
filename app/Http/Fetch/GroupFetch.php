<?php

namespace App\Http\Fetch;

use App\Models\Group;

class GroupFetch
{
    protected $group;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Handles querying of group model
     * 
     * @param array $params
     * @return mixed $group
     */
    public function execute($params)
    {
        $this->group = $this->group
                    ->whereLike('name', $params['name']);

        return $this->group->paginate(20);
    }
}
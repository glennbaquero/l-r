<?php

namespace App\Http\Fetch;

use App\Models\GroupPrivilege;

class GroupPrivilegeFetch
{
    protected $privilege;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(GroupPrivilege $privilege)
    {
        $this->privilege = $privilege;
    }

    /**
     * Handles querying of group privilege model
     * 
     * @param array $params
     * @return mixed $privilege
     */
    public function execute($params)
    {
        $this->privilege = $this->privilege
                    ->whereLike('menu', $params['menu']);

        return $this->privilege->paginate(20);
    }
}
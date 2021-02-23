<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
        'Username', 'Name', 'Group', 'Office', 'User Status', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'username', 'name', 'group', 'office'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($user) {
            return [
                'username' => $user->username,
                'name' => $user->fullname,
                'group' => $user->group->name,
                'office' => $user->office->name,
                'status' => $user->status,
                'showUrl' => route('user.show', $user->id),
                'deleteUrl' => route('user.destroy', $user->id),
            ];
        });
    }
}

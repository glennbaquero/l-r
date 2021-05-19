<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class PassengerCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
      'Fullname', 'E-mail', 'Phone Number',  'Created', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
       'name', 'email', 'phone_number', 'type', 'trip_id'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($passenger) {
            return [
                'fullname' => $passenger->fullname,
                'first_name' => $passenger->first_name,
                'last_name' => $passenger->last_name,
                'gender' => $passenger->gender,
                'email' => $passenger->email,
                'phone_number' => $passenger->phone_number,
                'code' => '---',
                'student_card' => '---',
                'f_creation' => Carbon::parse($passenger->created_at)->format('Y-m-d h:i A'),
                'f_subscription' => '---',
                // 'deleteUrl' => route('trip.destroy', $trip->id),
            ];
        });
    }
}

<?php

namespace App\Http\Fetch;

use App\Models\Office;
use App\Models\OfficeType;

class OfficeFetch
{
    protected $office;
    protected $type;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Office $office, OfficeType $type)
    {
        $this->office = $office;
        $this->type = $type;
    }

    /**
     * Handles querying of office model
     * 
     * @param array $params
     * @return mixed $office
     */
    public function execute($params)
    {
        $this->office = $this->office
                        ->whereLike('office_no', $params['office_no'])
                        ->orWhereLike('name', $params['name'])
                        ->orWhereLike('address_line_1', $params['address_line_1'])
                        ->orWhereLike('phone_number', $params['phone_number'])
                        ->orWhereLike('city', $params['city'])
                        ->orWhereLike('state', $params['state']);


        if($params['office_type'] && $params['office_type'] != 'null') {
            $office_type_ids = $this->type->whereLike('name', $params['office_type'])->pluck('id')->toArray();
            $this->office = $this->office->whereIn('office_type_id', $office_type_ids);
        }

        return $this->office->paginate(20);
    }
}
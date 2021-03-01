<?php

namespace App\Http\Fetch;

use App\Models\Company;

class CompanyFetch
{
    protected $company;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Handles querying of group model
     * 
     * @param array $params
     * @return mixed $company
     */
    public function execute($params)
    {
        $this->company = $this->company
                    ->whereLike('name', $params['name'])
                    ->orWhereLike('code', $params['code']);

        return $this->company->paginate(20);
    }
}
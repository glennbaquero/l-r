<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Driver extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Append additional attributes
     * 
     * @var array
     */
    protected $appends = ['fullname'];

    // Document Types constant variable
    const DNI = 'DNI';
    const Card = 'Card';
    const Passport = 'Passport';

    // Staff Types constant variable
    const Driver = 'Driver';
    const Hostess = 'Hostess';

    // Gender constant variable
    const Male = 'Male';
    const Female = 'Female';

    /**
     * Get user fullname
     * 
     * @return string
     */
    public function getFullnameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * [getDocumentTypes description]
     * @return array
     */
    public static function getDocumentTypes() {
        return [
            ['value' => static::DNI, 'name' => 'DNI'],
            ['value' => static::Card, 'name' => 'Card'],
            ['value' => static::Passport, 'name' => 'Passport'],
        ];
    }

    /**
     * [getStaffTypes description]
     * @return array
     */
    public static function getStaffTypes() {
        return [
            ['value' => static::Driver, 'name' => 'Driver'],
            ['value' => static::Hostess, 'name' => 'Hostess'],
        ];
    }

    /**
     * [getGenderTypes description]
     * @return array
     */
    public static function getGenderTypes() {
        return [
            ['value' => static::Male, 'name' => 'Male', 'id' => 'Male'],
            ['value' => static::Female, 'name' => 'Female', 'id' => 'Female'],
        ];
    }
}

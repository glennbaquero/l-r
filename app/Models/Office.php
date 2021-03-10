<?php

namespace App\Models;

use App\Traits\QueryLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    protected $appends = ['postal_code'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Office belongs to office type
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function officeType()
    {
        return $this->belongsTo(OfficeType::class);
    }

    /**
     * Office belongs to departure city
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_city_id', 'id');
    }

    /**
     * Office belongs to arrival city
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_city_id', 'id');
    }

    /**
     * Office belongs to terminal
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    /**
     * Office has many users
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get postal code
     * 
     * @return string
     */
    public function getPostalCodeAttribute()
    {
        return $this->zip;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

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
     * Scopes for matched string in query
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereLike($query, $field, $value)
    {
        if($value && $value != 'null') {
            return $query->where($field, 'like', '%' . $value . '%');
        }

        return;
    }
}

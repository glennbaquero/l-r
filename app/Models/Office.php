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
}

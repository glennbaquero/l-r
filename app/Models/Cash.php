<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryLike;

class Cash extends Model
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
    protected $appends = ['date'];
    
    /**
     * Cash belongs to User
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get date
     * 
     * @return string
     */
    public function getDateAttribute()
    {
        return $this->created_at->format('h:i A');
    }
        
    /**
     * Cash belongs to office
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office()
    {
        return $this->belongsTo(Office::class)->withTrashed();
    }
}

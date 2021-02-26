<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Dependence extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Deoendence belongs to many ticket types
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticket_types()
    {
        return $this->belongsToMany(TicketType::class);
    }
}

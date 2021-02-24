<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryLike;

class GroupPrivilege extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Group Privilege belongs to many groups
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}

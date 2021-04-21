<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryLike;

class MultiRoute extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Multi Route has many Multi Route Stops
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stops()
    {
        return $this->hasMany(MultiRouteStop::class);
    }


    /**
     * @return  array $items
     */
    
    public function getRoutePerStop()
    {
        $stops = $this->stops;
        $items = [];
        foreach ($stops as $stop) {
            array_push($items, $stop->routes()->pluck('route_id'));
        }

        return $items;
    }
}

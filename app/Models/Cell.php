<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class Cell extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    protected $appends = ['full_image_path'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Get full image path
     * 
     * @return string
     */
    public function getFullImagePathAttribute()
    {
        return url($this->image_path);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;


class Company extends Model
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
    protected $appends = ['full_image_path'];

    /**
     * Get user image
     * 
     * @return string
     */
    public function getFullImagePathAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}

<?php

namespace App\Traits;

trait QueryLike
{
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

    /**
     * Scopes for matched string in query
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrWhereLike($query, $field, $value)
    {
        if($value && $value != 'null') {
            return $query->orWhere($field, 'like', '%' . $value . '%');
        }

        return;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\QueryLike;

class TicketType extends Model
{
    use HasFactory, QueryLike, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Ticket type belongs to many dependence
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dependencies()
    {
        return $this->belongsToMany(Dependence::class);
    }

    /**
     * Ticket type belongs to user who created it
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withTrashed();
    }

    /**
     * Ticket type belongs to user who updated it 
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'edited_by', 'id')->withTrashed();
    }

    /**
     * Ticket type belongs to document type
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function document_type()
    {
        return $this->belongsTo(DocumentType::class)->withTrashed();
    }
}

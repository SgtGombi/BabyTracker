<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sleep extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     * Allow filling the fields defined in the migration.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'children_id',
        'date_from',
        'date_to',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class, 'children_id');
    }
}

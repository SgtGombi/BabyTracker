<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Child;

class Diaper extends Model
{
    use HasFactory;

    protected $table = 'diapers';

    protected $fillable = [
        'children_id',
        'date',
        'time',
        'diaper_type',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'children_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Child;

class Medication extends Model
{
    use HasFactory;

    protected $table = 'medications';

    protected $fillable = [
        'children_id',
        'medication_name',
        'quantity',
        'unit',
        'date',
        'time',
        'note',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'children_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Child;

class Meal extends Model
{
    use HasFactory;

    protected $table = 'meals';

    protected $fillable = [
        'children_id',
        'date',
        'time',
        'meal_type',
        'meal_name',
        'meal_quantity',
        'meal_unit',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'children_id');
    }
}

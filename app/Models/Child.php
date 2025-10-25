<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Meal;
use App\Models\Diaper;
use App\Models\Medication;

class Child extends Model
{
    use HasFactory;

    protected $table = 'children';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'age_months',
        'gender',
        'height',
        'weight',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function meals()
    {
        return $this->hasMany(Meal::class, 'children_id');
    }

    public function diapers()
    {
        return $this->hasMany(Diaper::class, 'children_id');
    }

    public function medications()
    {
        return $this->hasMany(Medication::class, 'children_id');
    }
}

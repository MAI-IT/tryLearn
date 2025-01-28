<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function registrations(){
        return $this->hasMany(Registration::class);
    }

    protected $fillable = [ 
        'name',
        'price',
        'start_date',
        'end_date',
        'details',
        'instructor_name',
    ];
}

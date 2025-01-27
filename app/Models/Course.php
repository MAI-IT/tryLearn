<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function registrations(){
        return $this->hasMany(Registration::class);
    }

    protected $fillable = [ 
        'title',
        'price', 
        'start_date',
        'end_date',
        'instructor_name' 
    ]; 
}

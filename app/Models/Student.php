<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;

      protected $fillable = [
        'name',
        'email',
        'course',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}

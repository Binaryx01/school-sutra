<?php

// app/Models/Teacher.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'email', 'phone',
        'qualification', 'address', 'joined_date', 'session_id',
    ];

    public function session()
    {
        return $this->belongsTo(SchoolSession::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'class_id', 'code', 'type'];

    public function schoolclass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
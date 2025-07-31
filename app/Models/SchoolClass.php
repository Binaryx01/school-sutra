<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['name'];

    // All sections belonging to this class
    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    // All subjects belonging to this class
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    // **All students belonging to this class regardless of section**
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}

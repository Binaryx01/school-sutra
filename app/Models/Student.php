<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   use HasFactory;

   protected $casts = [
    'date_of_birth' => 'date:Y-m-d', // Ensures proper Carbon conversion
];

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'class_id',
        'section_id',
        'guardian_name',
        'contact_number',
        'address',
    ];

    // Define relationship to class
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
        // Or use SchoolClass::class if you renamed the model
    }

    //  Define relationship to section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
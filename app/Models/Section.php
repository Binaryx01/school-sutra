<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ClassModel; 
class Section extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'name'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}

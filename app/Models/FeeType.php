<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    protected $fillable = ['name', 'description', 'is_active', 'is_one_time'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_one_time' => 'boolean',
    ];
}
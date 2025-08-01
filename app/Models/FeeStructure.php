<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolSession;

class FeeStructure extends Model
{
    protected $fillable = ['class_id', 'fee_type_id', 'session_id', 'amount', 'frequency', 'due_date'];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function session()
    {
        return $this->belongsTo(SchoolSession::class, 'session_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
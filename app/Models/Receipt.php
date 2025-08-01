<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['payment_id', 'receipt_number', 'issue_date', 'amount', 'notes'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
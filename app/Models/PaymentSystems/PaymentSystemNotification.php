<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSystemNotification extends Model
{
    protected $fillable = [
        'payment_system_id',
        'message_id',
        'message_body',
        'is_processed'
    ];

    public function paymentSystem() {
        return $this->belongsTo(PaymentSystem::class);
    }

    public function transaction() {
        return $this->hasOne(PaymentSystemTransaction::class);
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSystemTransaction extends Model
{
    protected $fillable = [
        'sum',
        'currency',
        'payment_system_id',
        'notification_id',
        'subscribe_id',
    ];

    public function notification() {
        return $this->belongsTo(PaymentSystemNotification::class);
    }
    public function subscribe() {
        return $this->belongsTo(UserHasSubscribe::class);
    }
    public function paymentSystem() {
        return $this->belongsTo(PaymentSystem::class);
    }
}
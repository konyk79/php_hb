<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Payum\LaravelPackage\Model\GatewayConfig;

class Payment extends Model
{
    protected $fillable = [
        'details',
        'refId',
        'payment_processor_id',
        'user_id',
        'user_subscribe_id',
        'recurring_payment_id'
    ];
    protected $table = 'payments';

    public function paymentProcessor() {
        return $this->belongsTo(PaymentSystemConfig::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function userSubscribe() {
        return $this->belongsTo(UserHasSubscribe::class);
    }
}


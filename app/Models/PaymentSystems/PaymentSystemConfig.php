<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Payum\LaravelPackage\Model\GatewayConfig;

class PaymentSystemConfig extends Model
{
    protected $fillable = [
        'config',
        'payment_system_id',
    ];
    protected $table = 'payment_system_configs';

    public function paymentSystem() {
        return $this->belongsTo(PaymentSystem::class);
    }
}


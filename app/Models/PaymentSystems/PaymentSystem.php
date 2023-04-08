<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PaymentSystem extends Model
{
    use Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = [
        'payment_processor_id',
        'name',
        'description'
    ];

    public function paymentProcessor() {
        return $this->hasOne(PaymentSystemConfig::class);
    }

    public function notifications() {
        return $this->hasMany(PaymentSystemNotification::class);
    }

    public function config() {
        return $this->hasOne(PaymentSystemConfig::class);
    }
}

class PaymentSystemTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}
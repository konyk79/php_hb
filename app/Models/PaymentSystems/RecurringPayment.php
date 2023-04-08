<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Payum\Core\Model\ArrayObject;
use Payum\LaravelPackage\Model\GatewayConfig;

class RecurringPayment extends Model
{
    protected $fillable = [
//        'details',
        'token',
        'transaction_id',
        'description',
        'email',
        'amount',
        'currency_code',
        'billing_frequency',
        'profile_start_date',
        'billing_period',
        'profile_id',
        'profile_status',
        'ack',
        'status',
        'payment_processor_id',
        'user_id',
        'user_subscribe_id'
    ];



    public function paymentProcessor() {
        return $this->belongsTo(GatewayConfig::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function userSubscribe() {
        return $this->belongsTo(UserHasSubscribe::class);
    }

    public function getArrayObject() {
        $result = new ArrayObject();

        // For PayPal
        $result['TOKEN']            = $this->token;
        $result['DESC']             = $this->description;
        $result['EMAIL']            = $this->email;
        $result['AMT']              = $this->amount;
        $result['CURRENCYCODE']     = $this->currency_code;
        $result['BILLINGFREQUENCY'] = $this->billing_frequency;
        $result['PROFILESTARTDATE'] = $this->profile_start_date;
        $result['BILLINGPERIOD']    = $this->billing_period;
        $result["PROFILEID"]        = $this->profile_id;
        $result["PROFILESTATUS"]    = $this->profile_status;
        $result["ACK"]              = $this->ack;
        $result["STATUS"]           = $this->status;

        return $result;
    }
    public function updateByArrayObject($arrayObject) {
        // For PayPal
        $this->token                = $arrayObject['TOKEN'];
        $this->description          = $arrayObject['DESC'];
        $this->email                = $arrayObject['EMAIL'];
        $this->amount               = $arrayObject['AMT'];
        $this->currency_code        = $arrayObject['CURRENCYCODE'];
        $this->billing_frequency    = $arrayObject['BILLINGFREQUENCY'];
        $this->profile_start_date   = $arrayObject['PROFILESTARTDATE'];
        $this->billing_period       = $arrayObject['BILLINGPERIOD'];
        $this->profile_id           = $arrayObject["PROFILEID"];
        $this->profile_status       = $arrayObject["PROFILESTATUS"];
        $this->ack                  = $arrayObject["ACK"];
        $this->status               = $arrayObject["STATUS"];

        return $this;
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}


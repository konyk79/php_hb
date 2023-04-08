<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    //
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user_has_subscribe() {
        return $this->belongsTo(UserHasSubscribe::class);
    }
}
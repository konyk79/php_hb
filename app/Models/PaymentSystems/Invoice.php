<?php
/**
 * Created by IntelliJ IDEA.
 * User: anant
 * Date: 24.02.2018
 * Time: 8:37
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }
}
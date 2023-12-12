<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StockTransactions;
use App\Traits\BankingTransactions;

/**
 * Class Invoice
 *
 * @property $id
 * @property $customer_id
 * @property $invoice_number
 * @property $invoice_date
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Customer $customer
 * @property InvoiceItem[] $invoiceItems
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Invoice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps, StockTransactions, BankingTransactions;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id','invoice_number','invoice_date','account_id','payment_type','order_type','payment','status'];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->invoice_number = 'IN-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    /**
     * Calculate the total amount of the bill.
     *
     * @return float
    */
    public function calculateTotalAmount()
    {
        $total = 0;
        foreach($this->invoiceItems as $item)
        {
            $total += $item->quantity*$item->rate;
        }
        return $total;
    }

    /**
     * Interact with the date.
     */
    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = strtotime($value);
    }

    /**
     * Interact with the date.
     */
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoiceItems()
    {
        return $this->hasMany('App\Models\InvoiceItem', 'invoice_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StockTransactions;

/**
 * Class Bill
 *
 * @property $id
 * @property $vendor_id
 * @property $bill_number
 * @property $bill_date
 * @property $due_date
 * @property $paid_amount
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property BillItem[] $billItems
 * @property Vendor $vendor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Bill extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps, StockTransactions;


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_id','bill_number','bill_date','due_date','paid_amount','status'];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->bill_number = 'BN-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
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
        foreach($this->billItems as $item)
        {
            $total += getAmount($item->purchaseItem, $item->quantity, $item->rate);
        }
        return $total;
    }

    /**
     * Interact with the date.
     */
    public function setBillDateAttribute($value)
    {
        $this->attributes['bill_date'] = strtotime($value);
    }

    /**
     * Interact with the date.
     */
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billItems()
    {
        return $this->hasMany('App\Models\BillItem', 'bill_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne('App\Models\Vendor', 'id', 'vendor_id');
    }
}

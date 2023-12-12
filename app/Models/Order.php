<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StockTransactions;

/**
 * Class Order
 *
 * @property $id
 * @property $shop_id
 * @property $worker_id
 * @property $order_number
 * @property $issue_date
 * @property $receive_date
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property OrderIssueItem[] $orderIssueItems
 * @property OrderReceiveItem[] $orderReceiveItems
 * @property Shop $shop
 * @property Worker $worker
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps, StockTransactions;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'worker_id',
        'order_number',
        'issue_date',
        'receive_date',
        'status'
    ];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->order_number = 'ON-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
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
        foreach($this->receiveItems as $item)
        {
            $total += $item->quantity*$item->rate;
        }
        return $total;
    }

    /**
     * Interact with the date.
     */
    public function setIssueDateAttribute($value)
    {
        $this->attributes['issue_date'] = strtotime($value);
    }

    /**
     * Interact with the date.
     */
    public function setReceiveDateAttribute($value)
    {
        $this->attributes['receive_date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issueItems()
    {
        return $this->hasMany('App\Models\OrderIssueItem', 'order_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receiveItems()
    {
        return $this->hasMany('App\Models\OrderReceiveItem', 'order_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shop()
    {
        return $this->hasOne('App\Models\Shop', 'id', 'shop_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne('App\Models\Worker', 'id', 'worker_id');
    }
}
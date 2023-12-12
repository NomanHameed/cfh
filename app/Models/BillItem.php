<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class BillItem
 *
 * @property $id
 * @property $bill_id
 * @property $purchase_item_id
 * @property $quantity
 * @property $rate
 * @property $created_at
 * @property $updated_at
 *
 * @property Bill $bill
 * @property PurchaseItem $purchaseItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BillItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['bill_id','purchase_item_id','quantity','rate'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bill()
    {
        return $this->hasOne('App\Models\Bill', 'id', 'bill_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchaseItem()
    {
        return $this->hasOne('App\Models\PurchaseItem', 'id', 'purchase_item_id');
    }
}

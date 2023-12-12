<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PurchaseDetail
 *
 * @property $id
 * @property $purchase_item_id
 * @property $type
 * @property $date
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property PurchaseItem $purchaseItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PurchaseDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['purchase_item_id','type','date','quantity'];

    /**
     * Interact with the date.
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchaseItem()
    {
        return $this->hasOne('App\Models\PurchaseItem', 'id', 'purchase_item_id');
    } 
}
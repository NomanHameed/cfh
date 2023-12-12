<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PurchaseStock
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
class PurchaseStock extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['purchase_item_id','quantity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function item()
    {
        return $this->hasOne('App\Models\PurchaseItem', 'id', 'purchase_item_id');
    }
}
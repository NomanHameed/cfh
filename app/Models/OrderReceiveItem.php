<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class OrderReceiveItem
 *
 * @property $id
 * @property $order_id
 * @property $sale_item_id
 * @property $plan_quantity
 * @property $product_quantity
 * @property $rate
 * @property $created_at
 * @property $updated_at
 *
 * @property Order $order
 * @property SaleItem $saleItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrderReceiveItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','sale_item_id','plan_quantity','product_quantity','rate'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne('App\Models\Order', 'id', 'order_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function saleItem()
    {
        return $this->hasOne('App\Models\SaleItem', 'id', 'sale_item_id');
    }
    
}
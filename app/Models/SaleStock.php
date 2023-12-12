<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SaleStock
 *
 * @property $id
 * @property $sale_item_id
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property SaleItem $saleItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SaleStock extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sale_item_id','quantity'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function saleItem()
    {
        return $this->hasOne('App\Models\SaleItem', 'id', 'sale_item_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SaleIngredient
 *
 * @property $id
 * @property $sale_item_id
 * @property $itemable_type
 * @property $itemable_id
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property SaleItem $saleItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SaleIngredient extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;



    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sale_item_id','itemable_type','itemable_id','quantity'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function saleItem()
    {
        return $this->belongsTo(SaleItem::class);
    }

    public function itemable()
    {
        return $this->morphTo();
    }

}

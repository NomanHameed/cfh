<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class SaleDetail
 *
 * @property $id
 * @property $sale_item_id
 * @property $type
 * @property $date
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property SaleItem $saleItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SaleDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sale_item_id','type','date','quantity'];

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
    public function saleItem()
    {
        return $this->hasOne('App\Models\SaleItem', 'id', 'sale_item_id');
    }
}
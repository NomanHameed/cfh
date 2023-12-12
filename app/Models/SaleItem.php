<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SaleItem
 *
 * @property $id
 * @property $name
 * @property $measurment_unit_id
 * @property $price
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SaleItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'measurment_unit_id' , 'price', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany('App\Models\SaleDetail', 'sale_item_id', 'id');
    }

    public function invoiceItems()
    {
        return $this->hasMany('App\Models\InvoiceItem', 'sale_item_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\MeasurmentUnit', 'measurment_unit_id','id');
    }


    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe', 'id', 'sale_item_id');
    }

        public function saleIngredients(){
        return$this->hasMany(SaleIngredient::class);
    }
}

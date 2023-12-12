<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MeasurmentUnit
 *
 * @property $id
 * @property $name
 * @property $minimum_value
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MeasurmentUnit extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, Userstamps;


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','minimum_value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */

    public function purchaseItem()
    {
        return $this->hasMany('App\Models\PurchaseItem', 'measurment_unit_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */

    public function saleItem()
    {
        return $this->hasMany('App\Models\SaleItem', 'measurment_unit_id', 'id');
    }


}

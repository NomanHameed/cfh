<?php

namespace App\Models;

use App\Traits\BankingTransactions;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PurchasePayment
 *
 * @property $id
 * @property $vendor_id
 * @property $date
 * @property $amount
 * @property $created_at
 * @property $updated_at
 *
 * @property Vendor $vendor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PurchasePayment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use BankingTransactions;


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_id','date','amount', 'status'];

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
    public function vendor()
    {
        return $this->hasOne('App\Models\Vendor', 'id', 'vendor_id');
    }

}

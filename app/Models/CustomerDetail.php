<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;

/**
 * Class CustomerDetail
 *
 * @property $id
 * @property $reference
 * @property $detail
 * @property $date
 * @property $type
 * @property $amount
 * @property $balance
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CustomerDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id','reference','detail','date','type','amount','balance'];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $lastBalance = DB::table('customer_details')->where('customer_id', $model->customer_id)->latest('id')->value('balance');
            $lastBalance = $lastBalance ?? 0;

            if ($model->type == 'Paid') {
                $model->balance = $lastBalance - $model->amount;
            }
            if ($model->type == 'Received') {
                $model->balance = $lastBalance + $model->amount;
            }
        });
    }

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
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
}

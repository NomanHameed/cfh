<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;

/**
 * Class WorkersDetail
 *
 * @property $id
 * @property $worker_id
 * @property $reference
 * @property $detail
 * @property $date
 * @property $type
 * @property $amount
 * @property $balance
 * @property $created_at
 * @property $updated_at
 *
 * @property Worker $worker
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WorkerDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['worker_id','reference','detail','date','type','amount','balance'];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) { 
            $lastBalance = DB::table('worker_details')->where('worker_id', $model->worker_id)->latest('date')->value('balance');
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
    public function worker()
    {
        return $this->hasOne('App\Models\Worker', 'id', 'worker_id');
    } 
}
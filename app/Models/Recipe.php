<?php

namespace App\Models;

use App\Traits\StockTransactions;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Recipe
 *
 * @property $id
 * @property $sale_item_id
 * @property $name
 * @property $recipe_number
 * @property $quantity
 * @property $date
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property RecipeIssueItem[] $recipeIssueItems
 * @property SaleItem $saleItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Recipe extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    use StockTransactions;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['recipe_name_id','recipe_number','quantity','date','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function recipeName()
    {
        return $this->hasOne('App\Models\RecipeName', 'id', 'recipe_name_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipeIssueItems()
    {
        return $this->hasMany('App\Models\RecipeIssueItem', 'recipe_id', 'id');
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasOne
//     */
//    public function saleItem()
//    {
//        return $this->hasOne('App\Models\SaleItem', 'id', 'sale_item_id');
//    }

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->recipe_number = 'RN-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = strtotime($value);
    }

    public function saleIngredients()
    {
        return $this->morphOne(SaleIngredient::class, 'itemable');
    }

//    public function issueItems()
//    {
//        $this->hasMany('App\Models\RecipeIssueItem', 'recipe_id', 'id');
//    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class RecipeIssueItem
 *
 * @property $id
 * @property $recipe_id
 * @property $purchase_item_id
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property PurchaseItem $purchaseItem
 * @property Recipe $recipe
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RecipeIssueItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;



    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['recipe_id','purchase_item_id','quantity'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchaseItem()
    {
        return $this->hasOne('App\Models\PurchaseItem', 'id', 'purchase_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipe()
    {
        return $this->hasOne('App\Models\Recipe', 'id', 'recipe_id');
    }


}

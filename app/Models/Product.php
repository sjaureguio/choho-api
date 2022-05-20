<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_type_id',
        'name',
        'unit_price',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    /**
     * Get the product_type that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
}

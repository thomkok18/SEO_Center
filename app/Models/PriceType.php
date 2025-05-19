<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_nl',
        'price',
    ];

    /**
     * Get the promotion url that the promotion url type owns.
     *
     * @return HasMany
     */
    public function promotionUrl(): HasMany
    {
        return $this->hasMany(PromotionUrl::class);
    }
}

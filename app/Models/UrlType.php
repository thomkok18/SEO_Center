<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class UrlType extends Model
{
    use HasFactory;

    /**
     * Get the website that the promotion url owns.
     *
     * @return HasMany
     */
    public function promotionUrl(): HasMany
    {
        return $this->hasMany(PromotionUrl::class);
    }

    /**
     * Get url type id by url type name.
     *
     * @param string $urlTypeName
     * @return array
     */
    public static function getUrlTypeIdByUrlTypeName(string $urlTypeName): array
    {
        return DB::table('url_types')->select('id')->where('name', '=', $urlTypeName)->get()->toArray();
    }
}

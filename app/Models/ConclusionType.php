<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ConclusionType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the promotion url that the conclusion type owns.
     *
     * @return HasMany
     */
    public function promotionUrl(): HasMany
    {
        return $this->hasMany(PromotionUrl::class);
    }

    /**
     * Get conclusion id by searching the conclusion name.
     *
     * @param string $name
     * @return Collection
     */
    public static function getConclusionIdByName(string $name): Collection
    {
        return DB::table('conclusion_types')
            ->where('name', '=', $name)
            ->select('id')
            ->get();
    }

    /**
     * Get conclusion name by id.
     *
     * @param int $id
     * @return object
     */
    public static function getConclusionNameById(int $id): object
    {
        return DB::table('conclusion_types')
            ->where('id', '=', $id)
            ->select('name')
            ->first();
    }

    /**
     * Specific conclusion types.
     *
     * @var int
     */
    public const PENDING = 1;
    public const ACCEPTED = 2;
    public const TEMPORARY_ACCEPTED = 3;
    public const TEMPORARY_DENIED = 4;
    public const TEMPORARY_EXPIRED = 5;
    public const DENIED = 6;
    public const IN_QUARANTINE = 7;
    public const IN_QUARANTINE_DOMAIN = 8;
    public const IN_QUARANTINE_IP = 9;
    public const IN_QUARANTINE_AUTHOR = 10;
    public const CHECK_AGAIN = 11;
}

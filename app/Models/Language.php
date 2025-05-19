<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Language extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Get the user that the language owns.
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the language code by language id.
     *
     * @param int $id
     * @return string
     */
    public static function getLanguageCodeById(int $id): string {
        $language = DB::table('languages')
            ->select('languages.code')
            ->leftJoin('users', 'users.language_id', '=', 'languages.id')
            ->where('languages.id', '=', $id)
            ->get();

        return $language[0]->code;
    }

    /**
     * Specific user languages.
     *
     * @var int
     */
    public const EN = 1;
    public const NL = 2;
}

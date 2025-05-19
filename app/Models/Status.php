<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the user that the status owns.
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Specific user statuses.
     *
     * @var int
     */
    public const ENABLED = 1;
    public const DISABLED = 2;
}

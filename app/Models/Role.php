<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
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
     * Get the user that the role owns.
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Specific user roles.
     *
     * @var int
     */
    public const ADMIN = 1;
    public const SUPPLIER = 2;
    public const SEO = 3;
    public const CUSTOMER = 4;
}

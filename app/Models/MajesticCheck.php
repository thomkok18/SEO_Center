<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MajesticCheck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain_name',
        'citation_flow',
        'trust_flow',
        'indexed_at',
    ];

    /**
     * Get the check check that the majestic check owns.
     *
     * @return HasMany
     */
    public function check(): HasMany
    {
        return $this->hasMany(Check::class);
    }
}

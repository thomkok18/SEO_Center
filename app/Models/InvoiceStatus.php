<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoiceStatus extends Model
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
     * Get the invoice that the invoice status owns.
     *
     * @return HasMany
     */
    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Specific invoice statuses.
     *
     * @var int
     */
    public const PENDING = 1;
    public const PAID = 2;
    public const CANCELED = 3;
    public const DELAYED = 4;
}

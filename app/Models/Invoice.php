<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'supplier_id',
        'status_id',
        'date',
        'price',
    ];

    /**
     * Get the invoice websites that the invoice owns.
     *
     * @return HasMany
     */
    public function invoiceWebsite(): HasMany
    {
        return $this->hasMany(InvoiceWebsite::class);
    }

    /**
     * Get the invoice status that the invoice owns.
     *
     * @return BelongsTo
     */
    public function invoiceStatus(): BelongsTo
    {
        return $this->belongsTo(InvoiceStatus::class);
    }
}

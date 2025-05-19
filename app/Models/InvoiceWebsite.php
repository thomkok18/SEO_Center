<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceWebsite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'website_id',
    ];

    /**
     * Get the invoice that the invoice websites owns.
     *
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the website that the invoice websites owns.
     *
     * @return BelongsTo
     */
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}

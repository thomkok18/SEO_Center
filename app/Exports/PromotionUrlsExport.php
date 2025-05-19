<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class PromotionUrlsExport implements FromArray
{
    protected array $promotionUrls;

    public function __construct(array $promotionUrls)
    {
        $this->promotionUrls = $promotionUrls;
    }

    public function array(): array
    {
        return $this->promotionUrls;
    }
}

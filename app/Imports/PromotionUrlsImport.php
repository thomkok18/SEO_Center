<?php

namespace App\Imports;

use App\Models\PromotionUrl;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class PromotionUrlsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|PromotionUrl|null
     */
    public function model(array $row): Model|PromotionUrl|null
    {
        return new PromotionUrl([
            'customer_id' => $row[0],
            'website_id' => $row[1],
            'url' => $row[2],
            'type' => $row[3],
            'price' => $row[4],
        ]);
    }
}

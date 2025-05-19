<?php

namespace App\Imports;

use App\Models\Link;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class LinksImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|Link|null
     */
    public function model(array $row): Model|Link|null
    {
        return new Link([
            'website' => $row[0],
            'anchor_text' => $row[1],
            'anchor_url' => $row[2],
        ]);
    }
}

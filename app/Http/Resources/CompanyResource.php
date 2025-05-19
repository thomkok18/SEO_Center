<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'debtor_number' => $this->debtor_number,
            'account_manager_email' => $this->account_manager_email,
            'archived' => $this->archived,
            'created_at' => $this->created_at->format('Y-m-d h:m:s'),
            'updated_at' => $this->updated_at->format('Y-m-d h:m:s'),
        ];
    }
}

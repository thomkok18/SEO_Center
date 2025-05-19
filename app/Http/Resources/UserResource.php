<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role_id' => $this->role_id,
            'first_name' => $this->first_name,
            'inserts' => $this->inserts ?? '',
            'last_name' => $this->last_name,
            'email' => $this->email,
            'company' => (object) [
                'id' => $this->company->id,
                'name' => $this->company->name,
                'debtor_number' => $this->company->debtor_number,
                'account_manager_email' => $this->company->account_manager_email,
                'archived' => $this->company->archived,
                'created_at' => $this->company->created_at->format('Y-m-d h:m:s'),
                'updated_at' => $this->company->updated_at->format('Y-m-d h:m:s'),
            ],
            'created_at' => $this->created_at->format('Y-m-d h:m:s'),
            'updated_at' => $this->updated_at->format('Y-m-d h:m:s'),
        ];
    }
}

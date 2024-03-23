<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'mobile' => $this->mobile,
            'name' => $this->name,
            'email' => $this->eamil,
            'createdAt' => $this->created_at,
            'lastLogin' => $this->email_verified_at,
        ];
    }
}

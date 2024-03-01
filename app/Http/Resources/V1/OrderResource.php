<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'totalPrice' => $this->total_price,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'address' => $this->whenLoaded('address', new AddressResource($this->address)),
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
        ];
    }
}

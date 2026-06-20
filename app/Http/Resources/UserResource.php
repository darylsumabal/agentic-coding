<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at?->toDateTimeString(),
            'pivot' => $this->whenPivotLoaded('product_user', function () {
                return [
                    'product_id' => $this->pivot->product_id,
                    'user_id' => $this->pivot->user_id,
                    'quantity' => $this->pivot->quantity
                ];
            })
        ];
    }
}

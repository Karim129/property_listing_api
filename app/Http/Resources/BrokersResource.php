<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrokersResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'Brokers',
            'attributes' => $this->only([
                'name', 'address', 'city', 'zip_code', 'phone_number', 'logo_path',
            ]),
        ];
    }
}

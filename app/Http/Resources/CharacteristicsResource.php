<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacteristicsResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->only([
            'price', 'bedrooms', 'bathrooms', 'sqft', 'price_sqft', 'property_type', 'status',
        ]);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertiesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'type' => 'Properties',
            'attributes' => $this->only([
                'address',
                'listing_type',
                'city',
                'zip_code',
                'description',
                'build_year',
            ]),
            'relationships' => [
                'characteristics' => new CharacteristicsResource($this->characteristic),
                'broker' => new BrokersResource($this->broker),
            ],
        ];
    }
}

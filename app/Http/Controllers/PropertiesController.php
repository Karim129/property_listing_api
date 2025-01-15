<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\PropertiesResource;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PropertiesResource::collection(Property::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request): PropertiesResource
    {
        $validatedData = $request->validated();

        $property = Property::create($validatedData);

        $property->characteristic()->create(array_merge(
            ['property_id' => $property->id],
            $validatedData
        ));

        return new PropertiesResource($property);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property): PropertiesResource
    {
        return new PropertiesResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property): PropertiesResource
    {
        $property->fill($request->only([
            'broker_id', 'address', 'listing_type', 'city', 'zip_code', 'description', 'build_year',
        ]));

        $property->characteristic->fill($request->only([
            'price', 'bedrooms', 'bathrooms', 'sqft', 'price_sqft', 'property_type', 'status',
        ]));

        $property->push();

        return new PropertiesResource($property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([
            'success' => true,
            'message' => 'Property has been deleted from database',
        ]);
    }
}

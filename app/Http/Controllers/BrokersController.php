<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrokerRequest;
use App\Http\Resources\BrokersResource;
use App\Models\Broker;

class BrokersController extends Controller
{
    public function index()
    {
        return BrokersResource::collection(Broker::all());
    }

    public function store(StoreBrokerRequest $request): BrokersResource
    {
        return new BrokersResource(Broker::create($request->validated()));
    }

    public function show(Broker $broker): BrokersResource
    {
        return new BrokersResource($broker);
    }

    public function update(StoreBrokerRequest $request, Broker $broker): BrokersResource
    {
        $broker->update($request->validated());

        return new BrokersResource($broker);
    }

    public function destroy(Broker $broker): \Illuminate\Http\JsonResponse
    {
        $deleted = $broker->delete();

        return response()->json([
            'success' => $deleted,
            'message' => $deleted ? 'Broker has been deleted from database' : 'Failed to delete broker',
        ]);
    }
}

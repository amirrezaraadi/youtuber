<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Manager\Location;
use App\Repository\Manager\locationRepo;

class LocationController extends Controller
{
    public function __construct(public locationRepo $locationRepo)
    {
    }

    public function index()
    {
        return $this->locationRepo->index();
    }

    public function store(StoreLocationRequest $request)
    {
        $this->locationRepo->create($request->validated());
        return response()->json(['message' => 'success', 'status' => 'success'], 200);
    }


    public function show($location)
    {
        return $this->locationRepo->getFindId($location);
    }

    public function update(UpdateLocationRequest $request, $location)
    {
        $check = $this->locationRepo->getFindId($location);
        $this->locationRepo->update($request->validated(), $check);
        return response()->json(['message' => 'success update', 'status' => 'success'], 200);
    }


    public function destroy($location)
    {
        $check = $this->locationRepo->getFindId($location);
        $this->locationRepo->delete($check);
        return response()->json(['message' => 'success update', 'status' => 'success'], 200);
    }
}

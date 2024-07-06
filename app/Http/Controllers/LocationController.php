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


    public function show(Location $location)
    {
        //
    }


    public function edit(Location $location)
    {
        //
    }


    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }


    public function destroy(Location $location)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\Manager\City;
use App\Repository\Manager\cityRepo;
use App\Repository\Manager\provinceRepo;

class CityController extends Controller
{
    public function __construct(public cityRepo $cityRepo)
    {
    }

    public function index()
    {
        return $this->cityRepo->index();
    }

    public function store(StoreCityRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->cityRepo->create($request->validated());
        return response()->json(['message' => 'success', 'status' => 'success'], 200);
    }


    public function show($city)
    {
        return $this->cityRepo->getFindId($city);
    }

    public function update(UpdateCityRequest $request, $city): \Illuminate\Http\JsonResponse
    {
        $check = $this->cityRepo->getFindId($city);
        $this->cityRepo->update($request->validated(), $check);
        return response()->json(["message" => 'success', 'status' => 'success'], 200);
    }


    public function destroy($city): \Illuminate\Http\JsonResponse
    {
        $check = $this->cityRepo->getFindId($city);
        $this->cityRepo->delete($check);
        return response()->json(["message" => 'success', 'status' => 'success'], 200);
    }
}

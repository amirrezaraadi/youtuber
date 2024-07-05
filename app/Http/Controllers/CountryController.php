<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Manager\Country;
use App\Repository\Manager\countryRepo;

class CountryController extends Controller
{
    public function __construct(public countryRepo $countryRepo)
    {
    }

    public function index()
    {
        return $this->countryRepo->index();
    }

    public function store(StoreCountryRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->countryRepo->create($request->validated());
        return response()->json(["message" => 'success create country ', 'status' => 'success'], 200);
    }


    public function show($country)
    {
        return $this->countryRepo->getFindId($country);
    }

    public function update(UpdateCountryRequest $request, $country): \Illuminate\Http\JsonResponse
    {
        $check = $this->countryRepo->getFindId($country);
        $this->countryRepo->update($request->validated(), $check);
        return response()->json(['message' => 'success update', 'status' => 'success'], 200);
    }


    public function destroy($country)
    {
        //
    }
}

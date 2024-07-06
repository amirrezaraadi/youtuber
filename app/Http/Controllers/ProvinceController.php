<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Manager\Province;
use App\Repository\Manager\phoneRepo;
use App\Repository\Manager\provinceRepo;

class ProvinceController extends Controller
{
    public function __construct(public provinceRepo $provinceRepo)
    {
    }

    public function index()
    {
        return $this->provinceRepo->index();
    }

    public function store(StoreProvinceRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->provinceRepo->create($request->validated());
        return response()->json(['message' => 'success create provinces', 'status' => 'success'], 200);
    }


    public function show($province)
    {
        return $this->provinceRepo->getFindId($province);
    }

    public function update(UpdateProvinceRequest $request, $province)
    {
        $check = $this->provinceRepo->getFindId($province);
        $this->provinceRepo->update($request->validated(), $check);
        return response()->json(['message' => 'success update provinces', 'status' => 'success'], 200);
    }


    public function destroy($province)
    {
        //
    }
}

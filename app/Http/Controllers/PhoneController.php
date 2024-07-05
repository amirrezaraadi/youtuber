<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Models\Manager\Phone;
use App\Repository\Manager\phoneRepo;

class PhoneController extends Controller
{
    public function __construct(public phoneRepo $phoneRepo){}

    public function index()
    {
        return $this->phoneRepo->index();
    }

    public function store(StorePhoneRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->phoneRepo->create($request->validated());
        return response()->json(['message' => 'create phones' , 'status' => 'success'],200);
    }


    public function show($phone)
    {
        //
    }

    public function update(UpdatePhoneRequest $request, $phone)
    {
        //
    }


    public function destroy($phone)
    {
        //
    }
}

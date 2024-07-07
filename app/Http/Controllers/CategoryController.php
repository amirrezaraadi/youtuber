<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Manager\Category;
use App\Repository\Manager\categoryRepo;

class CategoryController extends Controller
{
    public function __construct(public categoryRepo $categoryRepo)
    {
    }

    public function index()
    {
        return $this->categoryRepo->index();
    }

    public function store(StoreCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->categoryRepo->create($request->validated());
        return response()->json(['message' => 'success', 'status' => 'success'], 200);
    }


    public function show($category)
    {
        return $this->categoryRepo->getFindId($category);
    }

    public function update(UpdateCategoryRequest $request, $category): \Illuminate\Http\JsonResponse
    {
        $check = $this->categoryRepo->getFindId($category);
        $this->categoryRepo->update($request->validated(), $check);
        return response()->json(['message' => 'success update controller ', 'status' => 'success'], 200);
    }


    public function destroy($category): \Illuminate\Http\JsonResponse
    {
        $check = $this->categoryRepo->getFindId($category);
        $this->categoryRepo->delete($check);
        return response()->json(['message' => 'success delete controller ', 'status' => 'success'], 200);
    }

    public function success($category): \Illuminate\Http\JsonResponse
    {
        $check = $this->categoryRepo->getFindId($category);
        $this->categoryRepo->status($check, Category::STATUS_USER_SUCCESS);
        return response()->json(['message' => 'change status successfully', 'status' => 'success'], 200);
    }

    public function pending($category): \Illuminate\Http\JsonResponse
    {
        $check = $this->categoryRepo->getFindId($category);
        $this->categoryRepo->status($check, Category::STATUS_USER_PENDING);
        return response()->json(['message' => 'change status successfully', 'status' => 'success'], 200);
    }

    public function reject($category): \Illuminate\Http\JsonResponse
    {
        $check = $this->categoryRepo->getFindId($category);
        $this->categoryRepo->status($check, Category::STATUS_USER_REJECT);
        return response()->json(['message' => 'change status successfully', 'status' => 'success'], 200);
    }
}

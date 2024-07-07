<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Manager\Category;
use App\Repository\Manager\categoryRepo;

class CategoryController extends Controller
{
    public function __construct(public categoryRepo $categoryRepo){}

    public function index()
    {
        return $this->categoryRepo->index();
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepo->create($request->validated());
        return response()->json(['message' => 'success' , 'status' => 'success'],200);
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        //
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {
        //
    }
}

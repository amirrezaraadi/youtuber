<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Manager\Tag;
use App\Repository\Manager\tagRepo;

class TagController extends Controller
{
    public function __construct(public tagRepo $tagRepo)
    {
    }

    public function index()
    {
        return $this->tagRepo->index();
    }

    public function store(StoreTagRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->tagRepo->create($request->validated());
        return response()->json(['message' => 'success create tags ', "status" => 'success'], 200);
    }


    public function show(Tag $tag)
    {
        //
    }


    public function edit(Tag $tag)
    {
        //
    }


    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }


    public function destroy(Tag $tag)
    {
        //
    }
}

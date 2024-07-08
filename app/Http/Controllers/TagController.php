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


    public function show($tag)
    {
        return $this->tagRepo->getFindId($tag);
    }


    public function update(UpdateTagRequest $request, $tag): \Illuminate\Http\JsonResponse
    {
        $tagId = $this->tagRepo->getFindId($tag);
        $this->tagRepo->update($request->validated(), $tagId);
        return response()->json(['message' => "success update tag ", 'status' => 'success'], 200);
    }


    public function destroy($tag): \Illuminate\Http\JsonResponse
    {
        $tagId = $this->tagRepo->getFindId($tag);
        $this->tagRepo->delete($tagId);
        return response()->json(['message' => "success update tag ", 'status' => 'success'], 200);
    }

    public function success($tagId): \Illuminate\Http\JsonResponse
    {
        $tagId = $this->tagRepo->getFindId($tagId);
        $this->tagRepo->status($tagId, Tag::STATUS_SUCCESS);
        return response()->json(['message' => "change status successfully  ", 'status' => 'success'], 200);
    }

    public function reject($tagId): \Illuminate\Http\JsonResponse
    {
        $tagId = $this->tagRepo->getFindId($tagId);
        $this->tagRepo->status($tagId, Tag::STATUS_REJECT);
        return response()->json(['message' => "change status successfully ", 'status' => 'success'], 200);
    }

    public function pending($tagId): \Illuminate\Http\JsonResponse
    {
        $tagId = $this->tagRepo->getFindId($tagId);
        $this->tagRepo->status($tagId, Tag::STATUS_PENDING);
        return response()->json(['message' => "change status successfully ", 'status' => 'success'], 200);
    }
}

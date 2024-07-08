<?php

namespace App\Repository\Manager;

use App\Models\Manager\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;

class tagRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Tag::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        $tagsArray = explode(',', implode(',', $data['title']));
        foreach ($tagsArray as $item) {
            $check = Tag::query()->where('title', $item)->first();
            if (is_null($check)) {
                $tags = Tag::query()->create([
                    'title' => $item,
                    'slug' => SlugService::createSlug(Tag::class, 'slug', $item),
                    'user_id' => auth()->id()
                ]);
            }
        }
    }

    public function explode($categories)
    {
        $tagsArray = explode(',', $categories);
        dd($tagsArray);
        return array_map(function ($category) {
            return preg_replace('/[\[\]\s]+/', '', $category);
        }, $tagsArray);
    }

    public function getFindId($tag)
    {
        return Tag::query()->findOrFail($tag);
    }

}

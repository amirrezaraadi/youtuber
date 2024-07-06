<?php

namespace App\Repository\Manager;

use App\Models\Manager\Province;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class provinceRepo
{

    public function index()
    {
        return Province::query()->paginate();
    }

    public function create($data)
    {
//        return Province::query()->create($data);
        return Province::query()->create([
            'name' => $data['name'],
            'country_id' => $data['country_id'],
            'slug' => SlugService::createSlug(Province::class, 'slug', $data['name']),
        ]);
    }

    public function getFindId($id)
    {
        return Province::query()->findOrFail($id);
    }

    public function update(mixed $data, $id)
    {
        return Province::query()->where('id', $id->id)->update([
            'name' => $data['name'] ?? $id->name,
            'country_id' => $data['country_id'] ?? $id->country_code,
            'slug' => SlugService::createSlug(Province::class, 'slug', $data['name']
                ?? $id->name),
        ]);
    }

    public function delete($id)
    {
        return Province::query()->where('id', $id->id)->delete();
    }
}

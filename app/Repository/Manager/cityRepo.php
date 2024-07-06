<?php

namespace App\Repository\Manager;

use App\Models\Manager\City;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class cityRepo
{

    public function index()
    {
        return City::query()->paginate();
    }

    public function create($data)
    {
//        return City::query()->create($data);
        return City::query()->create([
            'name' => $data['name'],
            'province_id' => $data['province_id'],
            'slug' => SlugService::createSlug(City::class, 'slug', $data['name']),
        ]);
    }

    public function getFindId($id)
    {
        return City::query()->findOrFail($id);
    }

    public function update(mixed $data, $id)
    {
        return City::query()->where('id', $id->id)->update([
            'name' => $data['name'] ?? $id->name,
            'province_id' => $data['province_id'] ?? $id->province_id,
            'slug' => SlugService::createSlug(City::class, 'slug', $data['name']
                ?? $id->name),
        ]);
    }

    public function delete($id)
    {
        return City::query()->where('id', $id->id)->delete();
    }
}

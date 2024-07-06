<?php

namespace App\Repository\Manager;

use App\Models\Manager\Country;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class countryRepo
{

    public function index()
    {
        return Country::query()->paginate();
    }

    public function create($data)
    {
//        return Country::query()->create($data);
        return Country::query()->create([
            'name' => $data['name'],
            'country_code' => $data['country_code'],
            'slug' => SlugService::createSlug(Country::class, 'slug', $data['name']),
        ]);
    }

    public function getFindId($id)
    {
        return Country::query()->findOrFail($id);
    }

    public function update(mixed $data, $id)
    {
        return Country::query()->where('id', $id->id)->update([
            'name' => $data['name'] ?? $id->name,
            'country_code' => $data['country_code'] ?? $id->country_code,
            'slug' => SlugService::createSlug(Country::class, 'slug', $data['name']
                ?? $id->name),
        ]);
    }

    public function delete($id)
    {
        return Country::query()->where('id', $id->id)->delete();
    }
}

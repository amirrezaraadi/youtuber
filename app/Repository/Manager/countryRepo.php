<?php

namespace App\Repository\Manager;

use App\Models\Manager\Country;
use Cviebrock\EloquentSluggable\Services\SlugService;

class countryRepo
{

    public function index()
    {
        return Country::query()->paginate();
    }

    public function create($data)
    {
        return Country::query()->create([
            'name' => $data['name'],
            'country_code' => ['country_code'],
            'slug' => SlugService::createSlug(Country::class , 'slug', $data['title']),
        ]);
    }

    public function getFindId($id)
    {
        return Country::query()->findOrFail($id);
    }
}

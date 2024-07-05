<?php

namespace App\Repository\Manager;

use App\Models\Manager\Phone;

class phoneRepo
{
    public function index()
    {
        return Phone::query()->paginate();
    }

    public function create($data)
    {
        return Phone::query()->create([
            "number" => $data['number'],
            'user_id' => $data['user_id'],
            'country_id' => $data['country_id'],
        ]);
    }

    public function getFindId($id)
    {
        return Phone::query()->findOrFail($id);
    }
}


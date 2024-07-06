<?php

namespace App\Repository\Manager;

use App\Models\Manager\Phone;
use Couchbase\PhraseSearchQuery;

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
            'user_id' => auth()->id() ,
            'country_id' => $data['country_id'],
        ]);
    }

    public function getFindId($id)
    {
        return Phone::query()->findOrFail($id);
    }

    public function update($data, $id)
    {
        return Phone::query()->where('id', $id->id)->update([
            "number" => $data['number'] ?? $id->number,
            'user_id' => auth()->id() ,
            'country_id' => $data['country_id'] ?? $id->country_id,
        ]);
    }

    public function delete($id)
    {
        return Phone::query()->where('id', $id->id)->delete();
//        return Phone::query()->where('id', $id->id)->forceDelete();
    }
}


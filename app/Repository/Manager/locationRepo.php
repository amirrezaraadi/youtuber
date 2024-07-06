<?php

namespace App\Repository\Manager;

use App\Models\Manager\Location;

class locationRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Location::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        return $this->query->create([
            'latitude' => $data["latitude"],
            'longitude' => $data["longitude"],
            'building_number' => $data["building_number"],
            'unit' => $data["unit"],
            "mobile" => $data["mobile"],
            "telephone" => $data["telephone"],
            "postal_code" => $data["postal_code"],
            "address" => $data["address"],
            'province_id' => $data["province_id"],
            'city_id' => $data["city_id"],
            'user_id' => auth()->id(),
        ]);
    }

    public function getFindId($location)
    {
        return $this->query->findOrFail($location);
    }

    public function update($data, $id)
    {
        return $this->query->where('id', $id->id)->update([
            'latitude' => $data["latitude"] ?? $id->latitude,
            'longitude' => $data["longitude"] ?? $id->longitude,
            'building_number' => $data["building_number"] ?? $id->building_number,
            'unit' => $data["unit"] ?? $id->unit,
            "mobile" => $data["mobile"] ?? $id->mobile,
            "telephone" => $data["telephone"] ?? $id->telephone,
            "postal_code" => $data["postal_code"] ?? $id->postal_code,
            "address" => $data["address"] ?? $id->address,
            'province_id' => $data["province_id"] ?? $id->province_id,
            'city_id' => $data["city_id"] ?? $id->city_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id', $id->id)->delete();
    }
}

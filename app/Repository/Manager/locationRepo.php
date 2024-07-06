<?php

namespace App\Repository\Manager;

use App\Models\Manager\Location;

class locationRepo
{
    private $query ;
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
            'latitude' => $data["latitude"] ,
            'longitude' => $data["longitude"] ,
            'building_number' => $data["building_number"] ,
            'unit' => $data["unit"] ,
            "mobile" => $data["mobile"] ,
            "telephone" => $data["telephone"] ,
            "postal_code" => $data["postal_code"] ,
            "address" => $data["address"] ,
            'province_id' => $data["province_id"] ,
            'city_id' => $data["city_id"] ,
            'user_id' => auth()->id(),
        ]);
    }
}

<?php

namespace App\Repository\Manager;

use App\Models\User;

class  userRepo
{
    public $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        dd($data);
    }
}

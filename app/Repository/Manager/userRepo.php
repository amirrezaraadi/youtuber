<?php

namespace App\Repository\Manager;

use App\Exceptions\InvalidTokenException;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $user = $this->query->create([
            'name' => Str::before($data["email"], "@"),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::uuid(),
        ]);
        event(new Registered($user));
        return $user->createToken(
            'token-name', ['*'], now()->addWeek()
        )->plainTextToken;
    }

    /**
     * @param $email
     * @return Builder|Model|object|null
     */
    public function getFindEmail($email)
    {
        return $this->query->where('email', $email)->first();
    }

    /**
     * @throws InvalidTokenException
     */
    public function checkuser($data)
    {
        $user = $this->getFindEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new InvalidTokenException('رمز یا پسورد شما باهم مطابقت ندارد :)');
        }
        return $user->createToken(
            'token-name', ['*'], now()->addWeek()
        )->plainTextToken;
    }


}

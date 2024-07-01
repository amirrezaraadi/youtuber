<?php

namespace App\Repository\Manager;

use App\Exceptions\InvalidTokenException;
use App\Models\User;
use Carbon\Carbon;
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
        return $this->generate($user);
    }

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
        return $this->generate($user);
    }

    private function generate( $user)
    {
        $tokenResult = $user->createToken('token-name', ['*'], now()->addYears());
        $token = $tokenResult->plainTextToken;
        $accessToken = $tokenResult->accessToken;
        $accessToken->last_used_at = Carbon::now();
        $accessToken->save();
        return $token ;
    }


}

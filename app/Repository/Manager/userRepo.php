<?php

namespace App\Repository\Manager;

use App\Exceptions\InvalidTokenException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
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
        $user->channel()->create([
            'name' => $user->name,
            'slug' => Str::slug($user->name),
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

    public function generate($user)
    {
        $tokenResult = $user->createToken('token-name', ['*'], now()->addYears());
        $token = $tokenResult->plainTextToken;
        $accessToken = $tokenResult->accessToken;
        $accessToken->last_used_at = Carbon::now();
        $accessToken->save();
        return $token;
    }

    public function createGoogle($google)
    {
        return $this->query->create([
            'name' => $google->name,
            'email' => $google->email,
            'email_verified' => Carbon::now(),
            'remember_token' => Carbon::now(),
        ]);
    }

    public function getFinId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function show()
    {
        // Todo Reaships
    }

    public function update($data, $id)
    {
        return $this->query->where('id', $id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id', $id)->delete();
    }
}

<?php
namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\DTO\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): array
    {
        return User::all()->toArray();
    }

    public function getById(string $id): ?User
    {
        return User::find($id);
    }

    public function create(UserDTO $userDTO): User
    {
        $user = new User();
        $user->id = Str:: uuid();
        $user->username = $userDTO->username;
        $user->email = $userDTO->email;
        $user->password = Hash::make($userDTO->password);
        $user->phoneNumber = $userDTO->phoneNumber;
        $user->role = $userDTO->role;
        $user->save();
        return $user;
    }

    public function update(string $id, UserDTO $userDTO): ?User
    {
        $user = $this->getById($id);
        if ($user) {
            $user->update($userDTO->toArray());
            return $user;
        }
        return null;
    }

    public function delete(string $id): bool
    {
        $user = $this->getById($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
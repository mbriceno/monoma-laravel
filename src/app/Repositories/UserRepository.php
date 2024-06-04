<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements BaseRepositoryInterface
{
    public const MANAGER_ROLE = 'manager';
    public const AGENT_ROLE = 'agent';

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function getAgent()
    {
        return User::where('role', self::AGENT_ROLE)->first();
    }

    public function getManger()
    {
        return User::where('role', self::MANAGER_ROLE)->first();
    }

    public function all($filters = [])
    {
        return User::all();
    }

    public function update(array $data, $id)
    {
    }

    public function delete($id)
    {
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }
}

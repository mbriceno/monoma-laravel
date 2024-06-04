<?php

namespace App\Services;

use App\Repositories\BaseRepositoryInterface;

class UserService
{
    public function __construct(
        protected BaseRepositoryInterface $userRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }
}

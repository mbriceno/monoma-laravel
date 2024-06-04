<?php

namespace App\Services;

use App\Repositories\BaseRepositoryInterface;

class CandidateService
{
    public function __construct(
        protected BaseRepositoryInterface $candidateRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->candidateRepository->create($data);
    }

    public function all($filters = [])
    {
        return $this->candidateRepository->all($filters);
    }

    public function findById($id)
    {
        return $this->candidateRepository->findById($id);
    }
}

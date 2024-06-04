<?php

namespace App\Repositories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

class CandidateRepository implements BaseRepositoryInterface
{
    public function create(array $data): Candidate
    {
        return Candidate::create($data);
    }

    public function all($filters = [])
    {
        if (isset($filters['user']) && $filters['user']->role == UserRepository::AGENT_ROLE) {
            return Cache::remember('owned_candidates', 60, function () use ($filters) {
                return Candidate::where(['owner' => $filters['user']->id])->get();
            });
        }

        return Cache::remember('all_candidates', 60, function () use ($filters) {
            return Candidate::all();
        });
    }

    public function update(array $data, $id)
    {
    }

    public function delete($id)
    {
    }

    public function findById($id)
    {
        try {
            return Candidate::findOrFail($id);
        } catch (ModelNotFoundException) {
            return null;
        }
    }
}

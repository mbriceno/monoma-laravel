<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidateA = Candidate::factory()->make([
            'source' => 'Linkedin',
            'owner' => app(UserRepository::class)->getAgent(),
            'created_by' => app(UserRepository::class)->getManger(),
        ]);

        $candidateA->save();

        $candidateB = Candidate::factory()->make([
            'source' => 'Facebook',
            'owner' => app(UserRepository::class)->getAgent(),
            'created_by' => app(UserRepository::class)->getManger(),
        ]);

        $candidateB->save();

        $candidateC = Candidate::factory()->make([
            'source' => 'Twitter',
            'owner' => app(UserRepository::class)->getManger(),
            'created_by' => app(UserRepository::class)->getManger(),
        ]);

        $candidateC->save();
    }
}

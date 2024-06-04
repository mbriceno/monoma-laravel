<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Models\Candidate;
use App\Services\CandidateService;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CandidateService $candidateService)
    {
        return $this->returnSuccessResponse($candidateService->all(['user' => auth()->user()]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateRequest $request, CandidateService $candidateService)
    {
        $data = $request->validated();
        return $this->returnSuccessResponse($candidateService->create($data)->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(CandidateService $candidateService, $id)
    {
        $candidate = $candidateService->findById($id);

        if ($candidate) {
            return $this->returnSuccessResponse($candidate);
        }

        return response()->json([
            'meta' => [
                'success' => false,
                'error' => ['No lead found'],
            ],
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }

    protected function returnSuccessResponse($data)
    {
        return response()->json([
            'meta' => [
                'success' => true,
                'error' => [],
            ],
            'data' => $data,
        ]);
    }
}

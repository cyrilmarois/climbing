<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAthleteRankingRequest;
use App\Http\Requests\UpdateAthleteRankingRequest;
use App\Models\AthleteRanking;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class AthleteRankingController
{
    public function index(): Response
    {
        return Inertia::render('athlete-rankings/Index', [
            'rankings' => AthleteRanking::query()
                ->with(['athlete', 'event'])
                ->latest('id')
                ->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('athlete-rankings/Create');
    }

    public function store(StoreAthleteRankingRequest $request): RedirectResponse
    {
        $ranking = AthleteRanking::query()->create($request->validated());

        return to_route('athlete-rankings.show', $ranking);
    }

    public function show(AthleteRanking $athleteRanking): Response
    {
        return Inertia::render('athlete-rankings/Show', [
            'ranking' => $athleteRanking->load(['athlete', 'event']),
        ]);
    }

    public function edit(AthleteRanking $athleteRanking): Response
    {
        return Inertia::render('athlete-rankings/Edit', [
            'ranking' => $athleteRanking,
        ]);
    }

    public function update(UpdateAthleteRankingRequest $request, AthleteRanking $athleteRanking): RedirectResponse
    {
        $athleteRanking->update($request->validated());

        return to_route('athlete-rankings.show', $athleteRanking);
    }

    public function destroy(AthleteRanking $athleteRanking): RedirectResponse
    {
        $athleteRanking->delete();

        return to_route('athlete-rankings.index');
    }
}

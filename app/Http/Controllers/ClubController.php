<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Club;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class ClubController
{
    public function index(): Response
    {
        return Inertia::render('clubs/Index', [
            'clubs' => Club::query()->with('country')->latest('id')->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('clubs/Create');
    }

    public function store(StoreClubRequest $request): RedirectResponse
    {
        $club = Club::query()->create($request->validated());

        return to_route('clubs.show', $club);
    }

    public function show(Club $club): Response
    {
        return Inertia::render('clubs/Show', [
            'club' => $club->load('country'),
        ]);
    }

    public function edit(Club $club): Response
    {
        return Inertia::render('clubs/Edit', [
            'club' => $club,
        ]);
    }

    public function update(UpdateClubRequest $request, Club $club): RedirectResponse
    {
        $club->update($request->validated());

        return to_route('clubs.show', $club);
    }

    public function destroy(Club $club): RedirectResponse
    {
        $club->delete();

        return to_route('clubs.index');
    }
}

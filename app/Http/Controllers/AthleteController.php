<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAthleteRequest;
use App\Http\Requests\UpdateAthleteRequest;
use App\Models\Athlete;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class AthleteController
{
    public function index(): Response
    {
        return Inertia::render('athletes/Index', [
            'athletes' => Athlete::query()->with('country')->latest('id')->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('athletes/Create');
    }

    public function store(StoreAthleteRequest $request): RedirectResponse
    {
        $athlete = Athlete::query()->create($request->validated());

        return to_route('athletes.show', $athlete);
    }

    public function show(Athlete $athlete): Response
    {
        return Inertia::render('athletes/Show', [
            'athlete' => $athlete->load('country'),
        ]);
    }

    public function edit(Athlete $athlete): Response
    {
        return Inertia::render('athletes/Edit', [
            'athlete' => $athlete,
        ]);
    }

    public function update(UpdateAthleteRequest $request, Athlete $athlete): RedirectResponse
    {
        $athlete->update($request->validated());

        return to_route('athletes.show', $athlete);
    }

    public function destroy(Athlete $athlete): RedirectResponse
    {
        $athlete->delete();

        return to_route('athletes.index');
    }
}

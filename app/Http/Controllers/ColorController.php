<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class ColorController
{
    public function index(): Response
    {
        return Inertia::render('colors/Index', [
            'colors' => Color::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('colors/Create');
    }

    public function store(StoreColorRequest $request): RedirectResponse
    {
        Color::query()->create($request->validated());

        return to_route('colors.index');
    }

    public function show(Color $color): Response
    {
        return Inertia::render('colors/Show', [
            'color' => $color,
        ]);
    }

    public function edit(Color $color): Response
    {
        return Inertia::render('colors/Edit', [
            'color' => $color,
        ]);
    }

    public function update(UpdateColorRequest $request, Color $color): RedirectResponse
    {
        $color->update($request->validated());

        return to_route('colors.index');
    }

    public function destroy(Color $color): RedirectResponse
    {
        $color->delete();

        return to_route('colors.index');
    }
}

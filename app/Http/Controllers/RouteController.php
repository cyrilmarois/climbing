<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Route;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class RouteController
{
    public function index(): Response
    {
        return Inertia::render('routes/Index', [
            'routes' => Route::query()
                ->with(['club', 'grade', 'color'])
                ->latest('id')
                ->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('routes/Create');
    }

    public function store(StoreRouteRequest $request): RedirectResponse
    {
        $route = Route::query()->create($request->validated());

        return to_route('routes.show', $route);
    }

    public function show(Route $route): Response
    {
        return Inertia::render('routes/Show', [
            'route' => $route->load(['club', 'grade', 'color', 'tags']),
        ]);
    }

    public function edit(Route $route): Response
    {
        return Inertia::render('routes/Edit', [
            'route' => $route,
        ]);
    }

    public function update(UpdateRouteRequest $request, Route $route): RedirectResponse
    {
        $route->update($request->validated());

        return to_route('routes.show', $route);
    }

    public function destroy(Route $route): RedirectResponse
    {
        $route->delete();

        return to_route('routes.index');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteRecordRequest;
use App\Http\Requests\UpdateRouteRecordRequest;
use App\Models\RouteRecord;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class RouteRecordController
{
    public function index(): Response
    {
        return Inertia::render('route-records/Index', [
            'records' => RouteRecord::query()
                ->with(['route', 'userProfile'])
                ->latest('id')
                ->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('route-records/Create');
    }

    public function store(StoreRouteRecordRequest $request): RedirectResponse
    {
        $record = RouteRecord::query()->create($request->validated());

        return to_route('route-records.show', $record);
    }

    public function show(RouteRecord $routeRecord): Response
    {
        return Inertia::render('route-records/Show', [
            'record' => $routeRecord->load(['route', 'userProfile']),
        ]);
    }

    public function edit(RouteRecord $routeRecord): Response
    {
        return Inertia::render('route-records/Edit', [
            'record' => $routeRecord,
        ]);
    }

    public function update(UpdateRouteRecordRequest $request, RouteRecord $routeRecord): RedirectResponse
    {
        $routeRecord->update($request->validated());

        return to_route('route-records.show', $routeRecord);
    }

    public function destroy(RouteRecord $routeRecord): RedirectResponse
    {
        $routeRecord->delete();

        return to_route('route-records.index');
    }
}

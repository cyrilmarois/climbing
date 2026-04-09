<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRecordRequest;
use App\Http\Requests\UpdateEventRecordRequest;
use App\Models\EventRecord;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class EventRecordController
{
    public function index(): Response
    {
        return Inertia::render('event-records/Index', [
            'records' => EventRecord::query()
                ->with(['event', 'userProfile'])
                ->latest('id')
                ->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('event-records/Create');
    }

    public function store(StoreEventRecordRequest $request): RedirectResponse
    {
        $record = EventRecord::query()->create($request->validated());

        return to_route('event-records.show', $record);
    }

    public function show(EventRecord $eventRecord): Response
    {
        return Inertia::render('event-records/Show', [
            'record' => $eventRecord->load(['event', 'userProfile']),
        ]);
    }

    public function edit(EventRecord $eventRecord): Response
    {
        return Inertia::render('event-records/Edit', [
            'record' => $eventRecord,
        ]);
    }

    public function update(UpdateEventRecordRequest $request, EventRecord $eventRecord): RedirectResponse
    {
        $eventRecord->update($request->validated());

        return to_route('event-records.show', $eventRecord);
    }

    public function destroy(EventRecord $eventRecord): RedirectResponse
    {
        $eventRecord->delete();

        return to_route('event-records.index');
    }
}

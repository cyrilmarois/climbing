<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class EventController
{
    public function index(): Response
    {
        return Inertia::render('events/Index', [
            'events' => Event::query()
                ->with(['country', 'club'])
                ->orderByDesc('date')
                ->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('events/Create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $event = Event::query()->create($request->validated());

        return to_route('events.show', $event);
    }

    public function show(Event $event): Response
    {
        return Inertia::render('events/Show', [
            'event' => $event->load(['country', 'club']),
        ]);
    }

    public function edit(Event $event): Response
    {
        return Inertia::render('events/Edit', [
            'event' => $event,
        ]);
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $event->update($request->validated());

        return to_route('events.show', $event);
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return to_route('events.index');
    }
}

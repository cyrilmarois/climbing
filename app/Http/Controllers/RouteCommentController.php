<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteCommentRequest;
use App\Http\Requests\UpdateRouteCommentRequest;
use App\Models\RouteComment;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class RouteCommentController
{
    public function index(): Response
    {
        return Inertia::render('route-comments/Index', [
            'comments' => RouteComment::query()
                ->with(['route', 'userProfile'])
                ->latest('id')
                ->paginate(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('route-comments/Create');
    }

    public function store(StoreRouteCommentRequest $request): RedirectResponse
    {
        $comment = RouteComment::query()->create($request->validated());

        return to_route('route-comments.show', $comment);
    }

    public function show(RouteComment $routeComment): Response
    {
        return Inertia::render('route-comments/Show', [
            'comment' => $routeComment->load(['route', 'userProfile']),
        ]);
    }

    public function edit(RouteComment $routeComment): Response
    {
        return Inertia::render('route-comments/Edit', [
            'comment' => $routeComment,
        ]);
    }

    public function update(UpdateRouteCommentRequest $request, RouteComment $routeComment): RedirectResponse
    {
        $routeComment->update($request->validated());

        return to_route('route-comments.show', $routeComment);
    }

    public function destroy(RouteComment $routeComment): RedirectResponse
    {
        $routeComment->delete();

        return to_route('route-comments.index');
    }
}

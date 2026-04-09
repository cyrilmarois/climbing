<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class TagController
{
    public function index(): Response
    {
        return Inertia::render('tags/Index', [
            'tags' => Tag::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('tags/Create');
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        Tag::query()->create($request->validated());

        return to_route('tags.index');
    }

    public function show(Tag $tag): Response
    {
        return Inertia::render('tags/Show', [
            'tag' => $tag,
        ]);
    }

    public function edit(Tag $tag): Response
    {
        return Inertia::render('tags/Edit', [
            'tag' => $tag,
        ]);
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->validated());

        return to_route('tags.index');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return to_route('tags.index');
    }
}

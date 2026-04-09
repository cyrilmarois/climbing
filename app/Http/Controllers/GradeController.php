<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Grade;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class GradeController
{
    public function index(): Response
    {
        return Inertia::render('grades/Index', [
            'grades' => Grade::query()->orderBy('system')->orderBy('sort_order')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('grades/Create');
    }

    public function store(StoreGradeRequest $request): RedirectResponse
    {
        Grade::query()->create($request->validated());

        return to_route('grades.index');
    }

    public function show(Grade $grade): Response
    {
        return Inertia::render('grades/Show', [
            'grade' => $grade,
        ]);
    }

    public function edit(Grade $grade): Response
    {
        return Inertia::render('grades/Edit', [
            'grade' => $grade,
        ]);
    }

    public function update(UpdateGradeRequest $request, Grade $grade): RedirectResponse
    {
        $grade->update($request->validated());

        return to_route('grades.index');
    }

    public function destroy(Grade $grade): RedirectResponse
    {
        $grade->delete();

        return to_route('grades.index');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class CountryController
{
    public function index(): Response
    {
        return Inertia::render('countries/Index', [
            'countries' => Country::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('countries/Create');
    }

    public function store(StoreCountryRequest $request): RedirectResponse
    {
        Country::query()->create($request->validated());

        return to_route('countries.index');
    }

    public function show(Country $country): Response
    {
        return Inertia::render('countries/Show', [
            'country' => $country,
        ]);
    }

    public function edit(Country $country): Response
    {
        return Inertia::render('countries/Edit', [
            'country' => $country,
        ]);
    }

    public function update(UpdateCountryRequest $request, Country $country): RedirectResponse
    {
        $country->update($request->validated());

        return to_route('countries.index');
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();

        return to_route('countries.index');
    }
}

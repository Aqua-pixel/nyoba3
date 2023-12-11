<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Perpustakaan;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePerpustakaanRequest;
use App\Http\Requests\UpdatePerpustakaanRequest;
use Illuminate\Http\Response;

class PerpustakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $perpustakaans = Perpustakaan::all();

        return response(view('Perpustakaans.index', ['Perpustakaans' => $perpustakaans]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response(view('Perpustakaans.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(StorePerpustakaanRequest $request)
    {
        if (Perpustakaan::create($request->validated())) {
            return redirect(route('Perpustakaans.index'))->with('success', 'Added!');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        dd('show');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $perpustakaan = Perpustakaan::findOrFail($id);

        return response(view('Perpustakaans.edit', ['Perpustakaan' => $perpustakaan]));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerpustakaanRequest $request, string $id)
    {
        $perpustakaan = Perpustakaan::findOrFail($id);

        if ($perpustakaan->update($request->validated())) {
            return redirect(route('Perpustakaans.index'))->with('success', 'Updated!'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $perpustakaan = Perpustakaan::findOrFail($id);

        if ($perpustakaan->delete()) {
            return redirect(route('Perpustakaans.index'))->with('success', 'Deleted!');
        }

        return redirect(route('Perpustakaans.index'))->with('error', 'Sorry, unable to delete this!');
    }
}

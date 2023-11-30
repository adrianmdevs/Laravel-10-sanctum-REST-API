<?php

namespace App\Http\Controllers;

use App\Models\Pupil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PupilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pupils.index',
            ['pupils'=>Pupil::all()->paginate(10)]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pupils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pupil::create($request->all());
        return redirect()->route('pupils.index')
            ->withSuccess('The new Pupil has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pupil $pupil): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pupils.show',
            ['pupil'=>$pupil]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pupil $pupil): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pupils.edit', [
            'pupil' => $pupil
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pupil $pupil) : RedirectResponse
    {
        $pupil->update($request->all());
        return redirect()->back()
            ->withSuccess('Pupil record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pupil $pupil) : redirectResponse
    {
        $pupil->delete();
        return redirect()->route('pupil.index')
            ->withSuccess('Pupil record is deleted successfully.');
    }
}

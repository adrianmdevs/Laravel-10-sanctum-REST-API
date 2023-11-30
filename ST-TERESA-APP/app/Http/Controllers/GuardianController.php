<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    //{
    //    return view('guardians.index',[
      //      'guardian'=>Guardian::all()->paginate(100)
       // ]);
    //

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('guardians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(Request $request)
    //{
      //  Guardian::create($request->all());
       // return redirect()->route('guardians.index')
         //   ->withSuccess('The new Guardian has been added successfully.');
   // }

    /**
     * Display the specified resource.
     */
    public function show(Guardian $guardian): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('guardians.index',[
            'guardian'=>$guardian
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        return view('guardians.edit', [
            'guardian' => $guardian
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian) : redirectResponse
    {
        $guardian->update($request->all());
        return redirect()->back()
            ->withSuccess('Guardian record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian) : redirectResponse
    {
        $guardian->delete();
        return redirect()->route('guardians.index')
            ->withSuccess('Guardian record deleted successfully.');
    }
}

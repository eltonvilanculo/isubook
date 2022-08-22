<?php

namespace App\Http\Controllers;

use App\Central;
use App\Provinces;
use Illuminate\Http\Request;

class CentralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $centrals = Central::with('province')->paginate(25);


        return view('logistic.centrals.index', compact('centrals'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $provinces = Provinces::all();

        return view('logistic.centrals.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Central $central)
    {
        //
        $central->create($request->all());

        return redirect()
            ->route('centrals.index')
            ->withStatus('Central criada com sucesso !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Central  $central
     * @return \Illuminate\Http\Response
     */
    public function show(Central $central)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Central  $central
     * @return \Illuminate\Http\Response
     */
    public function edit(Central $central)
    {
        //


        return view('logistic.centrals.edit', compact('central'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Central  $central
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Central $central)
    {
        //
        $central->update($request->all());

        return redirect()
            ->route('centrals.index')
            ->withStatus('Central actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Central  $central
     * @return \Illuminate\Http\Response
     */
    public function destroy(Central $central)
    {
        //
        $central->delete();

        return redirect()
            ->route('centrals.index')
            ->withStatus('Central removida.');
    }
}

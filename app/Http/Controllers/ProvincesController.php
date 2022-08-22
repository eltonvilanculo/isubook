<?php

namespace App\Http\Controllers;

use App\Provinces;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $provinces = Provinces::paginate(25);

        return view('logistic.provinces.index', compact('provinces'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('logistic.provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Provinces $province)
    {
        //
        $province->create($request->all());

        return redirect()
            ->route('provinces.index')
            ->withStatus('Pronvíncia criada com sucesso !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provinces  $provinces
     * @return \Illuminate\Http\Response
     */
    public function show(Provinces $provinces)
    {
        //
        return view('logistic.provinces.show', [
            'province' => $provinces,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provinces  $provinces
     * @return \Illuminate\Http\Response
     */
    public function edit(Provinces $province)
    {
        //
        return view('logistic.provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provinces  $provinces
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provinces $province)
    {
        //
        $province->update($request->all());

        return redirect()
            ->route('provinces.index')
            ->withStatus('Pronvíncia actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provinces  $provinces
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinces $province)
    {
        //

        $province->delete();

        return redirect()
            ->route('provinces.index')
            ->withStatus('Pronvíncia removida');
    }
}

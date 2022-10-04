<?php

namespace App\Http\Controllers;

use App\Estudante;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class EstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct() {
        Carbon::setlocale('pt');
    }

    public function index()
    {
        //
        $estudantes  =  Estudante::latest()->get();

        foreach ($estudantes as $key=>$estudante) {

            $estudantes[$key]['desde'] = Carbon::parse($estudante->created_at)->diffForHumans();
        }



        return view('registro.estudantes.index',compact('estudantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('registro.estudantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Estudante $estudante)
    {
        //
        $estudante->create($request->all());

        return redirect()
            ->route('estudantes.index')
            ->withStatus('Estudante cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudante  $estudante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudante $estudante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estudante  $estudante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudante $estudante)
    {
        //

        return view('registro.estudantes.edit',compact('estudante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudante  $estudante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudante $estudante)
    {
        //
        $estudante->update($request->all());

        return redirect()
            ->route('estudantes.index')
            ->withStatus('Dados do estudante actualizados !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudante  $estudante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudante $estudante)
    {
        //
        $estudante->delete($estudante);

        return redirect()
            ->route('estudantes.index')
            ->withStatus('Removido');
    }
}
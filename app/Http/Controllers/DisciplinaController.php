<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DisciplinaController extends Controller
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
        $disciplinas  =  Disciplina::all();

        foreach ($disciplinas as $key=>$disciplina) {

            $disciplinas[$key]['desde'] = Carbon::parse($disciplina->created_at)->diffForHumans();
        }



        return view('registro.disciplina.index',compact('disciplinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('registro.disciplina.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Disciplina $disciplina)
    {
        //
        $this->validate($request,[
            'nome'=>'unique:disciplinas',
            'abr'=>'unique:disciplinas'
        ]);
        $disciplina->create($request->all());

        return redirect()
            ->route('disciplinas.index')
            ->withStatus('disciplina cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplina $disciplina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplina $disciplina)
    {
        //
        return view('registro.disciplina.edit',compact('disciplina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disciplina $disciplina)
    {

        $this->validate($request,[
            'nome'=>[Rule::unique('disciplinas')->ignore($disciplina)],
            'abr'=>[Rule::unique('disciplinas')->ignore($disciplina)]
        ]);
        $disciplina->update($request->all());

        return redirect()
            ->route('disciplinas.index')
            ->withStatus('Dados do disciplina actualizados !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disciplina $disciplina)
    {
        //
        $disciplina->delete($disciplina);

        return redirect()
            ->route('disciplinas.index')
            ->withStatus('Removido !');
    }
}
<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Precedencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $disciplinas = Disciplina::all();
        return view('registro.disciplina.create',compact('disciplinas'));
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
       $data = $request->all();

        $newDisc = $disciplina->create($request->all());

        if($data['prec_id']){
            Precedencia::create(['prec_id' => $data['prec_id'],'ant_id'=>$newDisc->id]);
        }

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


        $precedencias  =  DB::table('precedencias')
                        ->join('disciplinas as prec','prec.id','=','precedencias.prec_id')
                        ->join('disciplinas as ant','ant.id','=','precedencias.ant_id')
                         ->select('precedencias.id', 'prec.nome','prec.id as prec_id')
                         ->where('ant.id', '=',$disciplina->id)
                         ->get();


        return view ('registro.disciplina.show',compact('disciplina','precedencias'));
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

    public function addprecedencia(Disciplina $disciplina){

        $disciplinas  =  Disciplina::all()->except($disciplina->id);
        return view('registro.disciplina.addprecedence',compact('disciplinas','disciplina'));
    }
    
    public function storeprecedencia(Request $request,Disciplina $disciplina){


            Precedencia::create(['prec_id' => $request->prec_id,'ant_id'=>$disciplina->id]);


        return redirect()
            ->route('disciplinas.show',$disciplina)
            ->withStatus('Precedência criada com sucesso!');
    }

}
<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Estudante;
use App\inscricao;
use App\inscricao_feita;
use App\Propina;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //



        $inscricoes = inscricao::all();

        // $query  =  DB::table('inscricoes')
        //                 ->join('estudantes','inscricoes.estudante_id','=','estudantes.id')
        //                 ->join('propinas','propinas.estudante_id','=','estudantes.id')
        //                  ->select('inscricoes.id','inscricoes.estado', 'estudantes.nome','propinas.duracao','propinas.estado as prop_estado')
        //                  ->get();


        //  $data =(array)$query;


        //  $inscricoes = $data["\x00*\x00items"] ;




        return view('registro.assignment.index',compact('inscricoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estudantes = Estudante::where('estado','pendente')->get();

        return view('registro.assignment.create', compact('estudantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['duracao'] = Carbon::now()->addMonths($data['type']);



        inscricao::create(['estudante_id'=>$data['estudante_id']]);

        Propina::create(['duracao'=>$data['duracao'],'estudante_id'=>$data['estudante_id']]);

        return redirect()
        ->route('inscricoes.index')
        ->withStatus('Estudante matriculado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
             $inscricao= inscricao::findOrFail($id); //





        return view('registro.assignment.show', ['inscricao' => $inscricao]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function edit(inscricao $inscricao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inscricao $inscricao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function destroy(inscricao $inscricao)
    {
        //






  }


  public function createRegister(inscricao $inscricao)
  {
      $disciplinas = Disciplina::all();


      return view('registro.assignment.assign', compact('inscricao', 'disciplinas'));
  }

  public function storeRegister(Request $request, inscricao $inscricao, inscricao_feita $matricula)
  {


      $data = $request->all();

      $data['inscricao_id']= $inscricao->id;

      $matricula->create($data);

      return redirect()
          ->route('inscricoes.show',$inscricao)
          ->withStatus('Cadeira associada ao estudante');
  }
}
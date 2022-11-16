<?php

namespace App\Http\Controllers;

use App\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $workers = Worker::latest()->paginate(25);
        foreach ($workers as $key=> $worker) {


            if($workers[$key]->last_travel){
                if(Carbon::parse($workers[$key]->last_travel)<Carbon::now()){
                    $workers[$key]->last_travel = null;
                    $workers[$key]->status = 0;
                    $workers[$key]->save();
                }else{

                    $workers[$key]['free_at'] = Carbon::parse($workers[$key]->last_travel)->diffForHumans();
                }
                $workers[$key]['eta'] = Carbon::parse($worker->updated_at)->diffForHumans();

            }
        }

        return view ('travel.workers.index',compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view ('travel.workers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Worker  $worker)
    {
        $worker->create($request->all());

        return redirect()
            ->route('workers.index')
            ->withStatus('Maquinista cadastrado com sucesso!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        //
        return view ('travel.workers.edit',compact('worker'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        //
        $worker->update($request->all());

        return redirect()
            ->route('workers.index')
            ->withStatus('Maquinista actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
}

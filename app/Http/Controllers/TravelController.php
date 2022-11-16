<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Train;
use App\Travel;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels  =  Travel::with('train')->with('worker')->latest()->paginate(25);

        return view('travel.assignment.index',compact('travels'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // $workers = Worker::where('status',0)->get();
        $trains = Train::where('status',0)->get();

        return view('travel.assignment.create', compact('trains'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Travel $model)
    {
        //


        // $worker =Worker::findOrFail($request->worker_id);
        // $worker->status =  1 ;
        $train  =  Train::findOrFail($request->train_id);
        $train->status =  1 ;

        $train->save();

          $travel =   $model->create($request->all());

        return redirect()
        ->route('travels.show', ['travel' => $travel->id])
        ->withStatus('Adicione Maquinistas ao comboio selecionado !');


    }

    public function addworker(Travel $travel)
    {

        $workersStandby = Worker::where('status', 2)->get();

        foreach ($workersStandby as $key=> $worker) {
            if($workersStandby[$key]->last_travel){
                if(Carbon::parse($workersStandby[$key]->last_travel)<Carbon::now()){
                    $workersStandby[$key]->last_travel = null;
                    $workersStandby[$key]->status = 0;
                    $workersStandby[$key]->save();
                }}

        }

        $workers = Worker::where('status', 0)->get();



        return view('travel.assignment.assign', compact('travel', 'workers'));
    }

    public function assignWorker(Request $request, Travel $travel, Assignment $assignment)
    {


        $data = $request->all();

        $data['travel_id']= $travel->id;

        $assignment->create($data);

        return redirect()
            ->route('travels.show', ['travel' => $travel])
            ->withStatus('Maquinista relacionado a viagem com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
        return view('travel.assignment.show', ['travel' => $travel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //

        $travel->status = 2;
        $travel->train->status  = 0 ;


        foreach ($travel->workers as $worker){
            $worker->worker->status= 2 ;
            $worker->worker->total_travel+= 1 ;
            $worker->worker->last_travel =Carbon::now()->addHours(8);

            $worker->worker->save();

        }

        $travel->train->save();
        $travel->save();
        return redirect()
        ->route('travels.index')
        ->withStatus('Viagem conculída com sucesso!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        //



        foreach ($travel->workers as $worker){
            $worker->worker->status= 0 ;
            $worker->worker->save();

        }
        $travel->status = 0;
        $travel->train->status  = 0 ;
        $travel->train->save();
        $travel->save();

        return redirect()
        ->route('travels.index')
        ->withStatus('Viagem cancelada com sucesso!');
    }


    public function finalize(Travel $travel){
        $travel->status =  1 ;//progress;
        $travel->train->status = 2; //traveling;

        foreach($travel->workers as $worker) {

            $worker->worker->status = 1;

            $worker->worker->save();
        }
        $travel->train->save();
        $travel->save();
        return redirect()
        ->route('travels.index')
        ->withStatus('Viagem iniciada com sucesso!');
    }
}

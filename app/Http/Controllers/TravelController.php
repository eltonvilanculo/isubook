<?php

namespace App\Http\Controllers;

use App\Train;
use App\Travel;
use App\Worker;
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

        $workers = Worker::where('status',0)->get();
        $trains = Train::all();

        return view('travel.assignment.create', compact('workers', 'trains'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Travel $travel)
    {
        //

        $worker =Worker::findOrFail($request->worker_id);
        $worker->status =  1 ;
     
        if($worker->save()){

            $travel->create($request->all());
        }
        return redirect()
            ->route('travels.index')
            ->withStatus('Viagem registada com sucesso!');


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
        $travel->save();
        $worker = Worker::findOrFail($travel->worker_id);
        $worker->status = 0;
        $worker->save();
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

        $travel->status = 0;
        $worker = Worker::findOrFail($travel->worker_id);
        $worker->status = 0;
        $worker->save();
        $travel->save();

        return redirect()
        ->route('travels.index')
        ->withStatus('Viagem cancelada com sucesso!');
    }
}
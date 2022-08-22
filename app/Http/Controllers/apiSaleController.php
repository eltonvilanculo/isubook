<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use App\SoldProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;

class apiSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Sale $model, SoldProduct $soldProduct)
    {
        //


        try {
            //code...
            $sale = $model->create($request->all());
            $product = Product::findOrFail($request->product_id);
             //user_id , //client_id

             $request->merge(['total_amount' => $product->price* $request->get('qty'),'sale_id'=>$sale->id,'product_id'=>$product->id]);

             $soldProduct->create($request->all());


              return response()->json(['response'=>$soldProduct,'status'=> $this->finalize($sale)],200);

        } catch (\Throwable $th) {
            throw $th;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function finalize($sale)
    {



        $sale->total_amount = $sale->products->sum('total_amount');

        foreach ($sale->products as $sold_product) {
            $product_name = $sold_product->product->name;
            $product_stock = $sold_product->product->stock;
            $sold_product['name']=$product_name;


            if($sold_product->qty > $product_stock) return back()->withError("The product '$product_name' does not have enough stock. Only has $product_stock units.");
        }

        foreach ($sale->products as $sold_product) {
            $sold_product->product->stock -= $sold_product->qty;
            $sold_product->product->save();
        }

        $sale->finalized_at = Carbon::now()->toDateTimeString();
        $sale->client->balance -= $sale->total_amount;
        $sale->save();
        $sale->client->save();
        $client = $sale->client->name ;
        $code = rand(1111111111111,9999999999999);
        Artisan::queue('send:sms',[
            'number'=>$sale->client->phone,
            'msg'=>"$client o seu  código da recarga é $code",
            'sale'=>$sale
        ]);

        // dd($sale);

        // http://127.0.0.1:8000/sales/17/finalize


        // return response()->json(['response'=>[
        //     'url'=>"http://127.0.0.1:8000/sales/$sale->id/finalize",
        //     'data'=>$sale
        // ]],200);


        return true;
        // return back()->withStatus('The sale has been successfully completed.');
    }
}

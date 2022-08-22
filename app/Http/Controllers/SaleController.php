<?php

namespace App\Http\Controllers;

use App\User;
use App\Sale;
use App\Product;
use Carbon\Carbon;
use App\SoldProduct;
use App\Transaction;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->paginate(25);

        if(Auth::user()->type==1){

            $sales = Sale::where('client_id',Auth::user()->id)->latest()->paginate(25);
        }

        // dd($sales);

        return view('sales.index', compact('sales'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = User::where('type',1)->get();

        if(Auth::user()->type==1){

            $clients = User::where('id',Auth::user()->id)->get();
        }
        return view('sales.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $model)
    {
        $existent = Sale::where('client_id', $request->get('client_id'))->where('finalized_at', null)->get();

        if($existent->count()) {
            return back()->withError('Já existe um pedido inacabado pertencente a este Utilizador. <a href="'.route('sales.show', $existent->first()).'">Clique aqui para ir até isso</a>');
        }

        $sale = $model->create($request->all());

        return redirect()
            ->route('sales.show', ['sale' => $sale->id])
            ->withStatus('Pedido registrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('sales.show', ['sale' => $sale]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->return_status = 'Devolvido';
        $sale->save();


        return redirect()
            ->route('sales.index')
            ->withStatus('O item do pedido foi devolvivo com sucesso.');
    }

    public function finalize(Sale $sale)
    {





        foreach ($sale->products as $sold_product) {
            $product_name = $sold_product->product->name;
            $product_stock = $sold_product->product->stock;
            $sold_product['name']=$product_name;


            if($sold_product->qty > $product_stock) return back()->withError("O item '$product_name' não tem estoque suficiente. Sobram apenas $product_stock unidades.");
        }

        foreach ($sale->products as $sold_product) {
            $sold_product->product->stock -= $sold_product->qty;
            $sold_product->product->save();
        }

        $sale->finalized_at = Carbon::now()->toDateTimeString();
        $sale->return_at = $sold_product->return_at ;
        $sale->return_status = 'Em emprestimo';
        $sale->save();
        $code = "Pedido de livro efectuado com sucesso!";
        // Artisan::queue('send:sms',[
        //     'number'=>$sale->client->phone,
        //     'msg'=>$code,
        //     'sale'=>$sale
        // ]);

        // dd($sale);

        // return view('sales.print',compact('sale'));


        return back()->withStatus('A o pedido foi concluído com sucesso.');
    }

    public function addproduct(Sale $sale)
    {
        $products = Product::all();

        return view('sales.addproduct', compact('sale', 'products'));
    }

    public function storeproduct(Request $request, Sale $sale, SoldProduct $soldProduct)
    {

        $soldProduct->create($request->all());

        return redirect()
            ->route('sales.show', ['sale' => $sale])
            ->withStatus('Item adicionado a lista de pedidos com sucesso!');
    }

    public function editproduct(Sale $sale, SoldProduct $soldproduct)
    {
        $products = Product::all();

        return view('sales.editproduct', compact('sale', 'soldproduct', 'products'));
    }

    public function updateproduct(Request $request, Sale $sale, SoldProduct $soldproduct)
    {
        $request->merge(['total_amount' => $request->get('price') * $request->get('qty')]);

        $soldproduct->update($request->all());

        return redirect()->route('sales.show', $sale)->withStatus('Item modificado com sucesso.');
    }

    public function destroyproduct(Sale $sale, SoldProduct $soldproduct)
    {
        $soldproduct->delete();

        return back()->withStatus('O item foi descartado com sucesso.');
    }

    public function addtransaction(Sale $sale)
    {
        $payment_methods = PaymentMethod::all();

        return view('sales.addtransaction', compact('sale', 'payment_methods'));
    }

    public function storetransaction(Request $request, Sale $sale, Transaction $transaction)
    {
        switch($request->all()['type']) {
            case 'income':
                $request->merge(['title' => 'Payment Received from Sale ID: ' . $request->get('sale_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Sale Return Payment ID: ' . $request->all('sale_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }

        $transaction->create($request->all());

        return redirect()
            ->route('sales.show', compact('sale'))
            ->withStatus('Successfully registered transaction.');
    }

    public function edittransaction(Sale $sale, Transaction $transaction)
    {
        $payment_methods = PaymentMethod::all();

        return view('sales.edittransaction', compact('sale', 'transaction', 'payment_methods'));
    }

    public function updatetransaction(Request $request, Sale $sale, Transaction $transaction)
    {
        switch($request->get('type')) {
            case 'income':
                $request->merge(['title' => 'Payment Received from Sale ID: '. $request->get('sale_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'Sale Return Payment ID: '. $request->get('sale_id')]);

                if($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                }
                break;
        }
        $transaction->update($request->all());

        return redirect()
            ->route('sales.show', compact('sale'))
            ->withStatus('Successfully modified transaction.');
    }

    public function destroytransaction(Sale $sale, Transaction $transaction)
    {
        $transaction->delete();

        return back()->withStatus('Transaction deleted successfully.');
    }


}

@extends('layouts.app', ['page' => 'Informações do item', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informação do item</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Nome</th>
                            <th>Stock</th>
                            <th>Stock mínimo</th>

                            <th>Pedidos totais</th>

                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->stock_defective }}</td>

                                <td>{{ $product->solds->sum('qty') }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">últimos pedidos</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Data</th>
                            <th>ID do pedido</th>
                            <th>Quantidade</th>

                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($solds as $sold)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($sold->created_at)) }}</td>
                                    <td><a href="{{ route('sales.show', $sold->sale_id) }}">{{ $sold->sale_id }}</a></td>
                                    <td>{{ $sold->qty }}</td>

                                    <td class="td-actions text-right">
                                        <a href="{{ route('sales.show', $sold->sale_id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver pedido">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

 
@endsection

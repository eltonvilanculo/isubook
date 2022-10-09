@extends('layouts.app', ['page' => 'Estatísticas de inventário', 'pageSlug' => 'istats', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estatísticas por quantidade(TOP 15)</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Nome</th>
                        
                            <th>Pedidos anuais</th>

                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($soldproductsbystock as $soldproduct)
                                <tr>
                                    <td><a href="#">{{ $soldproduct->worker_id }}</a></td>
                                    <td><a href="#">{{ $soldproduct->train->route->name }}</a></td>
                                    <td>{{ $soldproduct->worker->name }}</td>

                                    <td>{{ $soldproduct->total_qty }}</td>

                                    <td class="td-actions text-right">
                                        <a href="#" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
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
    <div class="row">
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <h4 class="card-title">Estatísticas por pedido (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Nome</th>
                                <th>Pedido</th>

                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyincomes as $soldproduct)
                                    <tr>
                                        <td>{{ $soldproduct->worker_id }}</td>
                                        <td><a href="#">{{ $soldproduct->product->category->name }}</a></td>
                                        <td><a href="#">{{ $soldproduct->product->name }}</a></td>
                                        <td>{{ $soldproduct->total_qty }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <h4 class="card-title">Estatísticas por categoria(TOP 15)</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Nome</th>
                                <th>Pedido</th>

                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyavgprice as $soldproduct)
                                    <tr>
                                        <td>{{ $soldproduct->worker_id }}</td>
                                        <td><a href="#">{{ $soldproduct->product->category->name }}</a></td>
                                        <td><a href="#">{{ $soldproduct->product->name }}</a></td>
                                        <td>{{ $soldproduct->total_qty }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

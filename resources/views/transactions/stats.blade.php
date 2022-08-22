@extends('layouts.app', ['pageSlug' => 'tstats', 'page' => 'Statistics', 'section' => 'transactions'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Estatísticas de transação.</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary">
                                visualizarTransações
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Período</th>
                                <th>Transações</th>
                                <th>Renda</th>
                                <th>Despesas</th>
                                <th>Pagamentos</th>
                                <th>Saldo de caixa</th>
                                <th>Balanço total</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($transactionsperiods as $period => $data)
                                    <tr>
                                        <td>{{ $period }}</td>
                                        <td>{{ $data->count() }}</td>
                                        <td>@money($data->where('type', 'income')->sum('amount')) </td>
                                        <td>@money($data->where('type', 'expense')->sum('amount')) </td>
                                        <td>@money($data->where('type', 'payment')->sum('amount')) </td>
                                        <td>@money($data->where('payment_method_id', optional($methods->where('name', 'Cash')->first())->id)->sum('amount')) </td>
                                        <td>@money($data->sum('amount')) </td>
                                        <td></td>
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
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Saldos pendentes</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('clients.index') }}" class="btn btn-sm btn-primary">Veja os clientes.</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>Cliente</th>
                                <th>Compras</th>
                                <th>Transações</th>
                                <th>Balanço</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td><a href="{{ route('clients.show', $client) }}">{{ $client->name }}<br>{{ $client->document_type }}-{{ $client->document_id }}</a></td>
                                        <td>{{ $client->sales->count() }}</td>
                                        <td>@money($client->transactions->sum('amount')) </td>
                                        <td>
                                            @if ($client->balance > 0)
                                                <span class="text-success">@money($client->balance) </span>
                                            @elseif ($client->balance < 0.00)
                                                <span class="text-danger">@money($client->balance) </span>
                                            @else
                                                @money($client->balance)
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('clients.transactions.add', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Registre a transação">
                                                <i class="tim-icons icon-simple-add"></i>
                                            </a>
                                            <a href="{{ route('clients.show', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Veja o cliente">
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

        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Estatísticas por métodos</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('methods.index') }}" class="btn btn-sm btn-primary">Visualizar métodos</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>Método</th>
                                <th>Transações {{ $date->year }}</th>
                                <th>Balanço {{ $date->year }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($methods as $method)
                                    <tr>
                                        <td><a href="{{ route('methods.show', $method) }}">{{ $method->name }}</a></td>
                                        <td>@money($transactionsperiods['Year']->where('payment_method_id', $method->id)->count()) </td>
                                        <td>@money($transactionsperiods['Year']->where('payment_method_id', $method->id)->sum('amount')) </td>
                                        <td>
                                            <a href="{{ route('methods.show', $method) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Veja o método">
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
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Estatísticas de Pedidos.</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('sales.index') }}" class="btn btn-sm btn-primary">Ver Pedidos</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Período</th>
                        <th>Pedidos</th>
                        <th>Clientes.</th>
                        <th>Total de estoque</th>
                        <th data-toggle="tooltip" data-placement="bottom" title="Preço médio de ingresos por cada venda">Média</th>
                        <th>Quantidade faturada</th>
                        <th>Para finalizar</th>
                    </thead>
                    <tbody>
                        @foreach ($salesperiods as $period => $data)
                            <tr>
                                <td>{{ $period }}</td>
                                <td>{{ $data->count() }}</td>
                                <td>{{ $data->groupBy('client_id')->count() }}</td>
                                <td>{{ $data->where('finalized_at', '!=', null)->map(function ($sale) {return $sale->products->sum('qty');})->sum() }}</td>
                                <td>@money($data->avg('total_amount')) </td>
                                <td>@money($data->where('finalized_at', '!=', null)->map(function ($sale) {return $sale->products->sum('total_amount');})->sum()) </td>
                                <td>{{ $data->where('finalized_at', null)->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection

@extends('layouts.app', ['page' => 'Gestão de pedidos', 'pageSlug' => 'sales', 'section' => 'transactions'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Gestão de pedidos</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-primary">Novo pedido</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th>Data de pedido</th>
                                <th>Data de devolução</th>
                                {{--  <th>Cliente</th>  --}}
                                <th>Atendente</th>
                                <th>Utilizador</th>
                                <th>Itens</th>
                                <th>Total de estoque</th>
                                <th>Autorização</th>
                                <th>Estado de pedido</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)

                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                        <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>

                                        {{--  <td><a href="{{route('clients.show',$sale->client)}}">{{ $sale->client->name }}<br>{{ $sale->client->document_type }}-{{ $sale->client->document_id }}</a></td>  --}}
                                        <td>{{ $sale->user->name }}</td>
                                        <td>{{ $sale->client->name }}</td>
                                        <td>{{ $sale->products->count() }}</td>
                                        <td>{{ $sale->products->sum('qty') }}</td>
                                        <td>
                                            @if (!$sale->finalized_at)
                                                <span class="text-danger">Por finalizar</span>
                                            @else
                                                <span class="text-success">Finalizada</span>
                                            @endif
                                        </td>
                                        <td>{{ $sale->return_status }}</td>
                                        <td class="td-actions text-right">
                                            @if (!$sale->finalized_at)
                                                <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar pedido">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver pedido">
                                                    <i class="tim-icons icon-zoom-split"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('sales.destroy', $sale) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Devolver" onclick="confirm('Confirmar devolução?') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-add"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $sales->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

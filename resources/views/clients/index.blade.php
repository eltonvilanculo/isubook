@extends('layouts.app', ['page' => 'Clients', 'pageSlug' => 'clients', 'section' => 'clients'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Clientes.</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary">Adicionar cliente</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Nome</th>
                                <th>Contador</th>
                                <th>Celular</th>
                                <th>Compras</th>
                                <th>Pagamento total</th>
                                <th>Última compra</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}<br>{{ $client->document_type }}-{{ $client->document_id }}</td>
                                        <td>


                                            {{ $client->counter_number }}
                                        </td>
                                        <td>


                                            {{ $client->phone }}
                                        </td>
                                        <td>
                                            @if (round($client->balance) > 0)
                                                <span class="text-success">@money($client->balance) </span>
                                            @elseif (round($client->balance) < 0.00)
                                                <span class="text-danger">@money($client->balance) </span>
                                            @else
                                                @money($client->balance)
                                            @endif
                                        </td>
                                        <td>{{ $client->sales->count() }}</td>
                                        <td>@money($client->transactions->sum('amount')) </td>
                                        <td>{{ ($client->sales->sortByDesc('created_at')->first()) ? date('d-m-y', strtotime($client->sales->sortByDesc('created_at')->first()->created_at)) : 'N/A' }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('clients.show', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Client">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('clients.destroy', $client) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Client" onclick="confirm('Estás seguro que quieres eliminar a este Client? Los registros de sus compras y Transactions no serán eliminados.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
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
                        {{ $clients->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

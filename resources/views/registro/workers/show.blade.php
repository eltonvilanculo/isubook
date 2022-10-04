@extends('layouts.app', ['page' => 'Informação do utilizador', 'pageSlug' => 'clients', 'section' => 'clients'])

@section('content')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informação do utilizador</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>


                            <th>Total de pedidos</th>
                            <th>Último pedido</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>

                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->email }}</td>

                                <td>{{ $client->sales->count() }}</td>

                                <td>{{ (empty($client->sales)) ? date('d-m-y', strtotime($client->sales->reverse()->first()->created_at)) : 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

@extends('layouts.app', ['page' => 'Gestão de pedidos', 'pageSlug' => 'travels', 'section' => 'transactions'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Gestão de Atribuições</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('travels.create') }}" class="btn btn-sm btn-primary">Nova atribuição</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th>Maquinista</th>
                                <th>Comboio</th>
                                <th>Gestor</th>
                                <th>Data de criação</th>
                                <th>Previsão de término</th>
                                <th>Estado</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($travels as $travel)

                                    <tr>


                                        {{--  <td><a href="{{route('clients.show',$travel->client)}}">{{ $travel->client->name }}<br>{{ $travel->client->document_type }}-{{ $travel->client->document_id }}</a></td>  --}}
                                        <td>{{ $travel->worker->name }}</td>
                                        <td>{{ $travel->train->name }}</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td>{{ date('d-m-y', strtotime($travel->created_at))}}</td>
                                        <td>{{$travel->end_time}}</td>
                                        @switch($travel->status)

                                        @case(0)


                                        <td> <span class="text-danger">Viagem cancelada </span></td>
                                        @break
                                        @case(1)


                                        <td><span class="text-warning">Viagem em progresso</span></td>
                                        @break
                                        @case(2)


                                        <td><span class="text-success"> Viagem concluída </span></td>
                                        @break
                                        @endswitch
                                        @if($travel->status==1)
                                        <td class="td-actions text-right">

                                                <a href="{{ route('travels.edit', ['travel' => $travel]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Concluir viagem">
                                                    <i class="tim-icons icon-check-2"></i>
                                                </a>

                                            <form action="{{ route('travels.destroy', $travel) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Cancelar viagem" onclick="confirm('Confirmar cancelamento?') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $travels->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

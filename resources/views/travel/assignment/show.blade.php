@extends('layouts.app', ['page' => 'Gerir lista de Maquinistas', 'pageSlug' => 'travels', 'section' => 'travels'])

@section('content')
    @include('alerts.success')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Resumo das Atribuições</h4>
                        </div>
                        @if ($travel->status==3)
                            <div class="col-4 text-right">
                                @if ($travel->workers->count() == 0)
                                    <form action="{{ route('travels.destroy', $travel) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                           Excluir pedido
                                        </button>
                                    </form>
                                @else
                                @if(Auth::user()->type==0)
                                <button type="button" class="btn btn-sm btn-primary" onclick="confirm('Atenção: Iniciar viagem  ?') ? window.location.replace('{{ route('travels.finalize', $travel) }}') : ''">
                                 Iniciar a viagem
                                </button>


                                @endif
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Combôio</th>
                            <th>Quantidade de Maquinistas</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $travel->id }}</td>
                                <td>{{ date('d-m-y', strtotime($travel->created_at)) }}</td>
                                <td>{{ $travel->train->name }}</td>
                                <td>{{ $travel->workers->count() }}</td>
                                @switch($travel->status)
                                @case(1)
                                <td>Em Progresso</td>
                                @break
                                @case(2)
                                <td>Concluída</td>
                                @break
                                @case(3)
                                <td>Pendente</td>
                                @break
                                @endswitch

                        </tbody>
                    </table>
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
                            <h4 class="card-title">Detalhes dos Maquinistas: {{ $travel->workers->count() }}</h4>
                        </div>
                        @if ($travel->status==3)
                            <div class="col-4 text-right">
                                <a href="{{ route('travels.worker.add', ['travel' => $travel->id]) }}" class="btn btn-sm btn-primary">Acrescentar a lista de maquinistas</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Contacto</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($travel->workers as $assignment)
                                <tr>
                                    <td>{{ $assignment->worker->id }}</td>
                                    <td>{{ $assignment->worker->name }}</td>
                                    <td>{{ $assignment->worker->phone }}</td>

                                    <td class="td-actions text-right">
                                        @if(!$travel->status ==1)
                                            <a href="{{ route('travels.product.edit', ['travel' => $travel, 'soldproduct' => $sold_product]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar Pedido">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('travels.product.destroy', ['travel' => $travel, 'soldproduct' => $sold_product]) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Cancelar Pedido" onclick="confirm('Confirmar?') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        @endif
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

@push('js')
    <script src="{{ asset('assets') }}/js/sweetalerts2.js"></script>
@endpush

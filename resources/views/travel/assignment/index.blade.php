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

                                <th>Comboio</th>
                                <th>Gestor</th>
                                <th>Data de criação</th>
                                <th>Previsão de partida</th>
                                <th>Previsão de chegada</th>
                                <th>Estado</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($travels as $travel)
                                    <tr>


                                        <td>{{ $travel->train->name }}</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td>{{ date('d-m-y', strtotime($travel->created_at)) }}</td>
                                        <td>{{ $travel->start_at }}</td>
                                        <td>{{ $travel->end_at }}</td>
                                        @switch($travel->status)
                                            @case(1)
                                                <td>Em progresso</td>
                                            @break

                                            @case(2)
                                                <td>Finalizada</td>
                                            @break

                                            @case(3)
                                                <td>Em atribuição (pendente)</td>
                                            @break

                                            @case(0)
                                                <td>Cancelada</td>
                                            @break
                                        @endswitch


                                        <td class="td-actions text-right">

                                            <a href="{{ route('travels.show', $travel) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="Ver atribuições">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            @if($travel->status==1)
                                            <a href="{{ route('travels.edit', ['travel' => $travel]) }}"
                                                class="btn btn-link" data-toggle="tooltip" data-placement="bottom"
                                                title="Concluir viagem">
                                                <i class="tim-icons icon-check-2"></i>
                                            </a>

                                            <form action="{{ route('travels.destroy', $travel) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cancelar viagem"
                                                    onclick="confirm('Confirmar cancelamento?') ? this.parentElement.submit() : ''">
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
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $travels->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

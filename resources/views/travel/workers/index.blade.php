@extends('layouts.app', ['page' => 'Maquinistas', 'pageSlug' => 'workers', 'section' => 'workers'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Maquinistas.</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('workers.create') }}" class="btn btn-sm btn-primary">Adicionar maquinista</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="table">
                            <thead class=" text-primary">
                                <th>Nome</th>
                                <th>Contacto</th>
                                <th>Categoria</th>
                                <th>Viagens Realizadas</th>
                                <th>Estado de ocupação</th>
                                <th>Fazem</th>
                                <th>Estará livre em ?</th>

                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($workers as $worker)
                                    <tr>
                                        <td>{{ $worker->name }}</td>
                                        <td>


                                            {{ $worker->phone }}
                                        </td>
                                        <td>{{ $worker->type == 1 ? 'Maqnta A' : 'Maqnta B' }}</td>
                                        <td> {{ $worker->total_travel }}</td>
                                        @switch($worker->status)
                                            @case(0)
                                            <td> <span class="text-success">Livre</span> </td>
                                                @break
                                            @case(1)
                                            <td> <span class="text-primary">Ocupado(Em viagem)</span> </td>
                                                @break
                                            @case(2)
                                            <td> <span class="text-primary">Standby</span> </td>
                                                @break

                                            @case(3)
                                            <td> <span class="text-warning">Doente</span> </td>
                                                @break
                                            @case(4)
                                            <td> <span class="text-warning">Folga</span> </td>
                                                @break
                                            @case(5)
                                            <td> <span class="text-warning">Nojo</span> </td>
                                                @break

                                            @default

                                        @endswitch


                                        <td> {{ $worker->eta }}</td>
                                        @if($worker->last_travel)
                                        <td> {{ $worker->free_at}}</td>
                                        @else
                                        <td> Agora</td>
                                        @endif

                                        @if($worker->status!==1)
                                        <td class="td-actions text-right">
                                            {{--  <a href="{{ route('workers.show', $worker) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>  --}}
                                            <a href="{{ route('workers.edit', $worker) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="Editar maquinista">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            {{--  <form action="{{ route('workers.destroy', $worker) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip"
                                                    data-placement="bottom" title="Delete worker"
                                                    onclick="confirm('Estás seguro que quieres eliminar a este worker? Los registros de sus compras y Transactions no serán eliminados.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>  --}}
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
                        {{ $workers->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

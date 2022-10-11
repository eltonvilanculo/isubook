@extends('layouts.app', ['page' => 'Gestão de pedidos', 'pageSlug' => 'inscricoes', 'section' => 'transactions'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Gestão de Matrículas</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('inscricoes.create') }}" class="btn btn-sm btn-primary">Nova matrícula</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>

                                <th>ID</th>
                                <th>Estudante</th>
                                <th>Gestor</th>
                                <th>Data</th>
                                <th>Estado</th>

                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($inscricoes as $inscricao)
                                    <tr>


                                        {{--  <td><a href="{{route('clients.show',$inscricao->client)}}">{{ $inscricao->client->name }}<br>{{ $inscricao->client->document_type }}-{{ $inscricao->client->document_id }}</a></td>  --}}

                                        <td>{{ $inscricao->id}}</td>
                                        <td>{{ $inscricao->estudante->nome }}</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td>{{ date('d-m-y', strtotime($inscricao->created_at)) }}</td>
                                        <td>{{ $inscricao->estado }}</td>






                                        <td class="td-actions text-right">

                                            <a href="{{ route('inscricoes.show', $inscricao) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="Ver inscrições">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>


                                            <form action="{{ route('inscricoes.destroy', $inscricao) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cancelar"
                                                    onclick="confirm('Confirmar cancelamento?') ? this.parentElement.submit() : ''">
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

                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

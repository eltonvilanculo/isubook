@extends('layouts.app', ['page' => 'Informações da disciplina', 'pageSlug' => 'disciplinas', 'section' => 'disciplinas'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informação da disciplina</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Abreviatura</th>
                            <th>Precendências</th>
                            <th></th>

                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $disciplina->id }}</td>
                                <td>{{ $disciplina->nome }}</td>
                                <td>{{ $disciplina->abr }}</td>
                                <td>{{ count($precedencias) }}</td>
                                <td> <a href="{{ route('disciplina.precedencia', $disciplina) }}" class="btn btn-link"
                                        data-toggle="tooltip" data-placement="bottom" title="Adicionar precedencia">
                                        <i class="tim-icons icon-pencil"></i>
                                    </a></td>



                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Lista de Precendências de ({{ $disciplina->nome }})</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Disciplina Precedente</th>
                        </thead>
                        <tbody>
                            @foreach ($precedencias as $precedencia)
                                <tr>
                                    <td>{{ $precedencia->id }}</td>
                                    <td><a
                                            href="{{ route('disciplinas.show', $precedencia->prec_id) }}">{{ $precedencia->nome }}</a>
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

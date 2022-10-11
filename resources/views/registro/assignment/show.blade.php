@extends('layouts.app', ['page' => 'Gerir lista de Maquinistas', 'pageSlug' => 'inscricoes', 'section' => 'inscricoes'])

@section('content')
    @include('alerts.success')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Resumo da matrícula</h4>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Estudante</th>
                            <th>Disciplinas Inscritas</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $inscricao->id }}</td>
                                <td>{{ date('d-m-y', strtotime($inscricao->created_at)) }}</td>
                                <td>{{ $inscricao->estudante->nome }}</td>
                                <td>{{ $inscricao->matriculas->count() }}</td>
                                <td>{{ $inscricao->estado}}</td>


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
                            <h4 class="card-title">Detalhes das disciplinas inscritas: {{ $inscricao->matriculas->count() }}</h4>
                        </div>

                            <div class="col-4 text-right">
                                <a href="{{ route('inscricoes.disciplina.add', $inscricao->id) }}" class="btn btn-sm btn-primary">Acrescentar disciplinas</a>
                            </div>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Estado da inscrição</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($inscricao->matriculas as $matricula)
                                <tr>
                                    <td>{{ $matricula->disciplina->id }}</td>
                                    <td>{{ $matricula->disciplina->nome }}</td>
                                    <td>{{ $matricula->estado }}</td>


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

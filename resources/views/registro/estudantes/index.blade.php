@extends('layouts.app', ['page' => 'Gestão de Estudantes', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Estudantes</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('estudantes.create') }}" class="btn btn-sm btn-primary">Registar Estudante</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="table" >
                            <thead class=" text-primary">
                                <th scope="col">Nome Completo</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Género</th>
                                <th scope="col">Data de Nascimento</th>
                                <th scope="col">Criado</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($estudantes as $estudante)
                                    <tr>

                                        <td>{{ $estudante->nome }}</td>

                                        <td>{{ $estudante->celular }}</td>
                                        <td>{{ $estudante->endereco }}</td>
                                        <td>{{ $estudante->estado }}</td>
                                        <td>{{ $estudante->genero }}</td>
                                        <td>{{ $estudante->data_nascimento }}</td>
                                        <td>{{ $estudante->desde }}</td>


                                        <td class="td-actions text-right">
                                            <a href="{{ route('products.show', $estudante) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Detalhes do Estudante">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('estudantes.edit', $estudante) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar Estudante">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('estudantes.destroy', $estudante) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Apagar estudante" onclick="confirm('Tem certeza de que quer remover este Estudante?Os registros que contêm continuarão a existir.') ? this.parentElement.submit() : ''">
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
                    {{--  <nav class="d-flex justify-content-end">
                        {{ $estudantes->links() }}
                    </nav>  --}}
                </div>
            </div>
        </div>
    </div>

@endsection

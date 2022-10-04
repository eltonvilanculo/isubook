@extends('layouts.app', ['page' => 'Gestão de disciplinas', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Disciplinas</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('disciplinas.create') }}" class="btn btn-sm btn-primary">Registar disciplina</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="table" >
                            <thead class=" text-primary">
                                <th scope="col">Nome</th>
                                <th scope="col">Abreviatura</th>
                                <th scope="col">Criado</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($disciplinas as $disciplina)
                                    <tr>

                                        <td>{{ $disciplina->nome }}</td>

                                        <td>{{ $disciplina->abr }}</td>
                                    
                                        <td>{{ $disciplina->desde }}</td>


                                        <td class="td-actions text-right">
                                            <a href="{{ route('products.show', $disciplina) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Detalhes do disciplina">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('disciplinas.edit', $disciplina) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar disciplina">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('disciplinas.destroy', $disciplina) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Apagar disciplina" onclick="confirm('Tem certeza de que quer remover este disciplina?Os registros que contêm continuarão a existir.') ? this.parentElement.submit() : ''">
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
                        {{ $disciplinas->links() }}
                    </nav>  --}}
                </div>
            </div>
        </div>
    </div>

@endsection

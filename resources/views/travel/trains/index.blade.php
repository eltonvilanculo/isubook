@extends('layouts.app', ['page' => 'Gestão de combôios', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Combôios</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('trains.create') }}" class="btn btn-sm btn-primary">Novo item</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="table">
                            <thead class=" text-primary">
                                <th scope="col">Rota</th>
                                <th scope="col">Designação</th>
                                <th scope="col">Vagões</th>
                                {{--  <th scope="col"></th>  --}}
                            </thead>
                            <tbody>
                                @foreach ($trains as $train)
                                    <tr>
                                        <td><a href="{{ route('routes.show', $train->route) }}">{{ $train->route->name }}</a></td>
                                        <td>{{ $train->name }}</td>

                                        <td>{{ $train->vagons }}</td>
                                        {{--  <td>{{ $product->stock_defective }}</td>  --}}

                                        {{--  <td class="td-actions text-right">
                                            <a href="{{ route('products.show', $train) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mais detalhes">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $train) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar produto">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $train) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Excluir produto" onclick="confirm('Tem certeza de que quer remover este produto?Os registros que contêm continuarão a existir.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>  --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">
                        {{ $trains->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

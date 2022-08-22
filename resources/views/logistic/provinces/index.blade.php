@extends('layouts.app', ['page' => 'Sistema Acervo Académico Brazão Mazula', 'pageSlug' => 'provinces', 'section' => 'logistic'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Gestão de províncias</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('provinces.create') }}" class="btn btn-sm btn-primary">Nova província</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Nome</th>
                                <th scope="col">Região</th>
                                <th scope="col">Latitude</th>
                                <th scope="col">Longitude</th>

                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($provinces as $province)
                                    <tr>
                                        <td>{{ $province->name }}</td>

                                        <td>{{ $province->region}}</td>
                                        <td>{{ $province->lat}}</td>
                                        <td>{{ $province->lng}}</td>

                                        <td class="td-actions text-right">
                                            {{--  <a href="{{ route('provinces.show', $province) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mais detalhed">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>  --}}
                                            <a href="{{ route('provinces.edit', $province) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Category">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('provinces.destroy', $province) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Category" onclick="confirm('Are you sure you want to delete this category? All products belonging to it will be deleted and the records that contain it will not be accurate.') ? this.parentElement.submit() : ''">
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
                        {{ $provinces->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

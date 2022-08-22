@extends('layouts.app', ['page' => 'Sistema Acervo Académico Brazão Mazula', 'pageSlug' => 'Editar província', 'section' => 'logistic'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Editar província</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('provinces.index') }}" class="btn btn-sm btn-primary">Voltar a lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('provinces.update', $province) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">Informação da província</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome da delegação</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name', $province->name) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

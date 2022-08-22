@extends('layouts.app', ['page' => 'Sistema Acervo Académico Brazão Mazula', 'pageSlug' => 'Criar nova província', 'section' => 'logistica'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Nova província</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('provinces.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('provinces.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Informações da província</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('region') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="region">Região</label>
                                    <select name="region" id="region"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}">
                                        <option value="Sul" selected>Sul </option>
                                        <option value="Centro">Centro </option>
                                        <option value="Norte">Norte </option>
                                    </select>

                                    @include('alerts.feedback', ['field' => 'region'])
                                </div>
                                <div class="form-group{{ $errors->has('lat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="lat">Latitude</label>
                                    <input type="text" name="lat" id="lat" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'lat'])
                                </div>
                                <div class="form-group{{ $errors->has('lng') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="lng">Longitude</label>
                                    <input type="text" name="lng" id="lng" class="form-control form-control-alternative{{ $errors->has('lng') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'lng'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



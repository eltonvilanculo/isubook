@extends('layouts.app', ['page' => 'Sistema Acervo Académico Brazão Mazula', 'pageSlug' => 'Criar nova central', 'section' => 'logistica'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Nova central</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('centrals.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('centrals.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Informações da central</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('province_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="province_id">Região da central</label>
                                    <select name="province_id" id="province_id"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}">

                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" selected>{{ $province->name }} </option>
                                        @endforeach


                                    </select>

                                    @include('alerts.feedback', ['field' => 'province_id'])
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="lat">Contacto celular</label>
                                    <input type="text" name="phone" id="phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Celular" value="{{ old('Celular') }}"  autofocus>
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="lng">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}"  autofocus>
                                    @include('alerts.feedback', ['field' => 'email'])
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

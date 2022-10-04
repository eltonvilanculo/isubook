@extends('layouts.app', ['page' => 'Register Client', 'pageSlug' => 'workers', 'section' => 'workers'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Registrar Maquinista</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('workers.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('workers.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Informações do Maquinista </h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome</label>
                                    <input type="text" name="name" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="Nome" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>


                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">Telefone</label>
                                    <input type="text" name="phone" id="input-phone"
                                        class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        placeholder="Contacto" value="{{ old('phone') }}" required>
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Categoria</label>
                                    <select name="type" id="input-type"
                                        class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        required>
                                        <option value="1" selected>Maqnta A</option>
                                        <option value="2" selected>Maqnta B</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'type'])
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

@extends('layouts.app', ['page' => 'Novo Estudante', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Novo Estudante</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('estudantes.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('estudantes.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Dados do estudante</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome Completo</label>
                                    <input type="text" name="nome" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        placeholder="" value="{{ old('nome') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'nome'])
                                </div>
                                <div class="row">


                                    <div class="col">
                                        <label class="form-control-label" for="input-celular">Celular</label>
                                        <input type="text" name="celular" id="input-celular"
                                            class="form-control form-control-alternative{{ $errors->has('celular') ? ' is-invalid' : '' }}"
                                            placeholder="" value="{{ old('celular') }}" required autofocus>
                                        @include('alerts.feedback', ['field' => 'celular'])
                                    </div>
                                    <div class="col">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="text" name="email" id="input-email"
                                            class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="" value="{{ old('email') }}" required autofocus>
                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col">
                                        <label class="form-control-label" for="input-endereco">Endereço</label>
                                        <input type="text" name="endereco" id="input-endereco"
                                            class="form-control form-control-alternative{{ $errors->has('endereco') ? ' is-invalid' : '' }}"
                                            placeholder="" value="{{ old('endereco') }}" required autofocus>
                                        @include('alerts.feedback', ['field' => 'endereco'])
                                    </div>
                                    <div class="col">
                                        <label class="form-control-label" for="input-data_nascimento">Data de Nascimento</label>
                                        <input type="date" name="data_nascimento" id="input-data_nascimento"
                                            class="form-control form-control-alternative{{ $errors->has('data_nascimento') ? ' is-invalid' : '' }}"
                                            placeholder="" value="{{ old('data_nascimento') }}" required autofocus>
                                        @include('alerts.feedback', ['field' => 'data_nascimento'])
                                    </div>
                                    <div class="col">
                                        <label class="form-control-label" for="input-name">Género</label>
                                        <select name="gerenero" id="input-gerenero"
                                            class="form-select form-control-alternative{{ $errors->has('gerenero') ? ' is-invalid' : '' }}"
                                            required>


                                            <option value="masculino" selected>Masculino</option>
                                            <option value="feminino">Feminino</option>
                                            <option value="outro">Outro</option>


                                        </select>
                                        @include('alerts.feedback', ['field' => 'gerenero'])
                                    </div>
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

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush

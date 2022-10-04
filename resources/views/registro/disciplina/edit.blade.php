@extends('layouts.app', ['page' => 'Edit item', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Actualização de Dadas</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('disciplinas.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('disciplinas.update',$disciplina) }}" autocomplete="off">
                            @method('put')
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Dadas da disciplina {{ $disciplina->id }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome</label>
                                    <input type="text" name="nome" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        placeholder="" value="{{$disciplina->nome}}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'nome'])
                                </div>
                                <div class="form-group{{ $errors->has('abr') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-abr">Abreviatura</label>
                                    <input type="text" name="abr" id="input-abr"
                                        class="form-control form-control-alternative{{ $errors->has('abr') ? ' is-invalid' : '' }}"
                                        placeholder="" value="{{$disciplina->abr}}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'abr'])
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

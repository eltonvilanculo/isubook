@extends('layouts.app', ['page' => 'Editar Maquinista', 'pageSlug' => 'workers', 'section' => 'workers'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Actualização dos dados do Maquinista</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('workers.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('workers.update',$worker) }}" autocomplete="off">
                            @method('put')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Informações do Maquinista </h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome</label>
                                    <input type="text" name="name" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="Nome" value="{{$worker->name}}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>


                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">Telefone</label>
                                    <input type="text" name="phone" id="input-phone"
                                        class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        placeholder="Contacto" value="{{$worker->phone}}" required>
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Estado</label>
                                    <select name="status" id="input-status"
                                        class="form-select form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                        >
                                        @if($worker->status<3)
                                        <option>Selecionar estado</option>
                                        <option value="3" >Doente</option>
                                        <option value="4" >Folga</option>
                                        <option value="5" >Nojo</option>
                                        @else
                                        <option>Selecionar estado</option>
                                        <option value="0" >Livre</option>
                                        @endif
                                    </select>
                                    @include('alerts.feedback', ['field' => 'type'])
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


@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        });
    </script>

@endpush

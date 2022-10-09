@extends('layouts.app', ['page' => 'Novo Item', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Novo item</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('trains.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('trains.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">informação do item</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Designação</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('route_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Rota</label>
                                    <select name="route_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                        @foreach ($routes as $route)

                                                <option value="{{$route['id']}}" >{{$route['name']}}</option>

                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'route_id'])
                                </div>

                                <div class="form-group{{ $errors->has('vagon') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-vagon">Vagões</label>
                                    <input type="number" name="vagon" id="input-vagon" class="form-control form-control-alternative" placeholder="1" value="{{ old('vagon') }}" >
                                    @include('alerts.feedback', ['field' => 'vagon'])
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

@extends('layouts.app', ['page' => 'Atribuição', 'pageSlug' => 'travels', 'section' => 'transactions'])

@section('content')
    <div class="container-fluid mt--7">
        @include('alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Criação de viagem para atribuições</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('travels.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('travels.store') }}" autocomplete="off">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('train_id') ? ' has-danger' : '' }}">

                                    <label class="form-control-label" for="input-name">Lista de combôios disponíveis :
                                    </label>
                                    <select name="train_id" id="input-category"
                                        class="form-select form-control-alternative{{ $errors->has('train') ? ' is-invalid' : '' }}"
                                        required>
                                        @foreach ($trains as $train)
                                            @if ($train['id'] == old('train'))
                                                <option value="{{ $train['id'] }}" selected>{{ $train['name'] }} </option>
                                            @else
                                                <option value="{{ $train['id'] }}">{{ $train['name'] }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'train_id'])
                                </div>

                                <div class="form-group{{ $errors->has('start_at') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="start_at">Previsão de partida</label>
                                    <input type="datetime-local" name="start_at" id="start_at"
                                        class="form-control form-control-alternative{{ $errors->has('start_at') ? ' is-invalid' : '' }}"
                                        value="0" required>
                                    @include('alerts.feedback', ['field' => 'start_at'])
                                </div>
                                <div class="form-group{{ $errors->has('end_at') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="end_at">Previsão de chegada</label>
                                    <input type="datetime-local" name="end_at" id="end_at"
                                        class="form-control form-control-alternative{{ $errors->has('end_at') ? ' is-invalid' : '' }}"
                                        value="0" required>
                                    @include('alerts.feedback', ['field' => 'end_at'])
                                </div>
                                <button type="submit" class="btn btn-success mt-4">Prosseguir</button>
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

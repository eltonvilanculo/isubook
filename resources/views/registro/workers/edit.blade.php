@extends('layouts.app', ['page' => 'Edit Client', 'pageSlug' => 'clients', 'section' => 'clients'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('GESTÃO DE CLIENTES') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar ') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">


                        <form method="post" action="{{ route('clients.update', $client) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('DADOS DO CLIENTE') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('NOME') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $client->name) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>


                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('CELULAR') }}</label>
                                    <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ old('phone', $client->phone) }}" required>
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>

                                <div class="form-group{{ $errors->has('counter_number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-counter">{{ __('CONTADOR') }}</label>
                                    <input type="text" name="counter_number" id="input-counter" class="form-control form-control-alternative{{ $errors->has('counter_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Contador') }}" value="{{ old('counter_number', $client->counter_number) }}" required>
                                    @include('alerts.feedback', ['field' => 'counter_number'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Actualizar cliente') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@extends('layouts.app', ['page' => 'Atribuir ', 'pageSlug' => 'travels', 'section' => 'transactions'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Atribuir </h3>
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

                                <div class="form-group{{ $errors->has('worker_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Maquinista</label>
                                    <select name="worker_id" id="input-worker" class="form-select form-control-alternative{{ $errors->has('worker_id') ? ' is-invalid' : '' }}" required onchange="productChange()">
                                        @foreach ($workers as $worker)

                                                <option value="{{$worker['id']}}">{{ $worker->name }}</option>

                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'worker_id'])

                                </div>


                                   <div class="form-group{{ $errors->has('train_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-work">Comboio</label>
                                    <select name="train_id" id="input-train" class="form-select form-control-alternative{{ $errors->has('train_id') ? ' is-invalid' : '' }}" required >
                                        @foreach ($trains as $train)

                                                <option value="{{$train['id']}}">{{ $train->name }}</option>

                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'train_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="end_time">Data de devolução</label>
                                    <input type="datetime-local" name="end_time" id="end_time"  class="form-control form-control-alternative{{ $errors->has('end_time') ? ' is-invalid' : '' }}" value="0"  required>
                                    @include('alerts.feedback', ['field' => 'end_time'])
                                </div>


            </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Prosseguir</button>
                                </div>
                            </div>
                        </form>
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


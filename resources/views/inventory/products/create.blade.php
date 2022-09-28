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
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">informação do item</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Designação</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('product_category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Rota</label>
                                    <select name="product_category_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                        @foreach ($categories as $category)
                                            @if($category['id'] == old('document'))
                                                <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                                            @else
                                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_category_id'])
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">Descrição</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="Descrição" value="{{ old('description') }}" >
                                    @include('alerts.feedback', ['field' => 'description'])
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-stock">Vagões</label>
                                            <input type="number" name="stock" id="input-stock" class="form-control form-control-alternative" placeholder="Vagões disponíveis" value="{{ old('stock') }}" required>
                                            @include('alerts.feedback', ['field' => 'stock'])
                                        </div>
                                    </div>
                                    <div class="col-6" style="display:none">
                                        <div class="form-group{{ $errors->has('stock_defective') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-stock_defective"> Vagões mínima de alerta</label>
                                            <input type="number" name="stock_defective" id="input-stock_defective" class="form-control form-control-alternative" placeholder="Vagões mínima de alerta" value=0>
                                            @include('alerts.feedback', ['field' => 'stock_defective'])
                                        </div>
                                    </div>
                                    {{--  <div class="col-4">
                                        <div class="form-group{{ $errors->has('author') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Nome do Autor</label>
                                            <input name="author" id="input-price" class="form-control form-control-alternative" placeholder="Autor" value="{{ old('author') }}" required>
                                            @include('alerts.feedback', ['field' => 'author'])
                                        </div>
                                    </div>  --}}
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

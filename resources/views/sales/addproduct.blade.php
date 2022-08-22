

@extends('layouts.app', ['page' => 'Adicionar pedido', 'pageSlug' => 'sales', 'section' => 'transactions'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Adicionar pedido</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sales.show', [$sale->id]) }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales.product.store', $sale) }}" autocomplete="off">
                            @csrf

                            <div class="pl-lg-4">
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Item</label>
                                    <select name="product_id" id="input-product" class="form-select form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required onchange="productChange()">
                                        @foreach ($products as $product)
                                            @if($product['id'] == old('product_id'))
                                                <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} - Preço base: {{ $product->price }} MT</option>
{{--                                                <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} - Preço base: {{ $product->price }} MT</option>--}}
                                            @else
                                                <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="return_at">Data de devolução</label>
                                    <input type="date" name="return_at" id="return_at"  class="form-control form-control-alternative{{ $errors->has('return_at') ? ' is-invalid' : '' }}" value="0"  required>
                                    @include('alerts.feedback', ['field' => 'return_at'])
                                </div>

                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-qty">Quantidade</label>
                                    <input type="number" name="qty" id="input-qty" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
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
    <script>
        let input_qty = document.getElementById('input-qty');
        let input_price = document.getElementById('input-price');
        let input_total = document.getElementById('input-total');
        var productOptions = document.getElementById("input-product");
        var Select_productPrices = productOptions.options[productOptions.selectedIndex].value;
        var Input_productPrice = document.getElementById("input-price");
        var products = {!! json_encode($products) !!}
        Input_productPrice.value= Select_productPrices;
        products.forEach(function (item) {
            // console.log(item.price);
            if(Select_productPrices == item.id){
                Input_productPrice.value = item.price;
            }
        })
        input_qty.addEventListener('input', updateTotal);
        input_price.addEventListener('input', updateTotal);
        function updateTotal () {
            input_total.value = (parseInt(input_qty.value) * parseFloat(input_price.value))+"MT";
        }
        function productChange() {
            Select_productPrices = productOptions.options[productOptions.selectedIndex].value;
            // Input_productPrice.value= Select_productPrices;
            console.log(Select_productPrices);
            products.forEach(function (item) {
                // console.log(item.price);
                if(Select_productPrices == item.id){
                    Input_productPrice.value = item.price;
                }
            })
        }
    </script>
@endpush


@extends('layouts.app', ['page' => 'Nova disciplina', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $disciplina->nome }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('disciplinas.show',$disciplina) }}" class="btn btn-sm btn-primary">De volta à
                                    lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('disciplina.precedencia',$disciplina) }}" autocomplete="off">
                            @csrf


                            <div class="pl-lg-4">


                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Precendência com : </label>
                                    <select name="prec_id" id="input-prec_id"
                                        class="form-select form-control-alternative{{ $errors->has('prec_id') ? ' is-invalid' : '' }}">


                                        <option value="" selected>Nenhuma</option>

                                        @foreach ($disciplinas as $disciplina)
                                            <option value="{{ $disciplina->id }}">{{ $disciplina->nome  }} ({{ ($disciplina->abr) }})</option>
                                        @endforeach




                                    </select>
                                    @include('alerts.feedback', ['field' => 'prec_id'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Criar precedência</button>
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

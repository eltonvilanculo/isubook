

@extends('layouts.app', ['page' => 'Atribuir ', 'pageSlug' => 'inscricoes', 'section' => 'transactions'])

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
                                <a href="{{ route('inscricoes.index') }}" class="btn btn-sm btn-primary">De volta à lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('inscricoes.disciplina.store',$inscricao) }}" autocomplete="off">
                            @csrf

                            <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('disciplina_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Disciplina</label>
                                    <select name="disciplina_id" id="input-disciplina" class="form-select form-control-alternative{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required onchange="productChange()">
                                        @foreach ($disciplinas as $disciplina)

                                                <option value="{{$disciplina['id']}}">{{ $disciplina->nome }}</option>

                                        @endforeach
                                    </select>
                                    <input type="hidden" name="inscricao_id" value="{{$inscricao['id']}}" />
                                    @include('alerts.feedback', ['field' => 'disciplina_id'])

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


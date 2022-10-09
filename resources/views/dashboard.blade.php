@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Painel de Controle', 'section' => ''])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Viagens realizadas mensalmente</h5>
                            <h2 class="card-title">Actividade anual</h2>
                        </div>
                        {{--  <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Produtos</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Pagamentos</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Clientes</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            </div>
                        </div>  --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Combôios sem actividade</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bus-front-12 text-warning"></i> {{ $pending }}</h3>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Combôios em actividade</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bus-front-12 text-success"></i> {{ $done }}</h3>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Maquinistas disponíveis </h5>
                    <h3 class="card-title"><i class="tim-icons icon-bus-front-12 text-success"></i> {{ $availableWorker }}</h3>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-lg-3">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Maquinistas em actividade</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bus-front-12 text-warning"></i> {{ $busyWorker }}</h3>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Fila de viagens em progresso</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('travels.create') }}" class="btn btn-sm btn-primary">Atribuir Maquinista</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Data
                                    </th>
                                    <th>
                                        Combôio
                                    </th>
                                    <th>
                        Maquinistas
                                    </th>

                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unfinishedtravels as $travel)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($travel->created_at)) }}</td>
                                        <td><a
                                                href="">{{ $travel->train->name }}</a>
                                        </td>
                                        <td>{{ $travel->workers->count() }}</td>

                                        <td class="td-actions text-right">
                                            <a href="{{ route('travels.show', ['travel' => $travel]) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="Ver viagem">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Nova transação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transactions.create', ['type' => 'payment']) }}"
                            class="btn btn-sm btn-primary">Pagamento</a>
                        <a href="{{ route('transactions.create', ['type' => 'income']) }}"
                            class="btn btn-sm btn-primary">Fechamento
                        </a>
                        <a href="{{ route('transactions.create', ['type' => 'expense']) }}"
                            class="btn btn-sm btn-primary">Despesa</a>
                        <a href="{{ route('travels.create') }}" class="btn btn-sm btn-primary">Empréstimo</a>
                        <a href="{{ route('transfer.create') }}" class="btn btn-sm btn-primary">Transferência</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

    <script>
        var lastmonths = [];

        @foreach ($lastmonths as $id => $month)
            lastmonths.push('{{ strtoupper($month) }}')
        @endforeach

        var lastincomes = {{ $lastincomes }};
        var lastexpenses = {{ $lastexpenses }};
        var anualsales = {{ $anualsales }};
        var anualclients = {{ $anualclients }};
        var anualproducts = {{ $anualproducts }};
        var methods = [];
        var methods_stats = [];

        @foreach ($monthlybalancebymethod as $method => $balance)
            methods.push('{{ $method }}');
            methods_stats.push('{{ $balance }}');
        @endforeach

        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script>
@endpush

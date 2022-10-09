<div class="sidebar">
    <div class="sidebar-wrapper">
        <ul class="nav">



            @if (Auth::user()->type == 0)
                <li @if ($pageSlug == 'dashboard') class="active " @endif>
                    <a href="{{ route('home') }}">
                        <i class="tim-icons icon-chart-bar-32"></i>
                        <p>Relatórios de actividades</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#inventory" {{ $section == 'inventory' ? 'aria-expanded=true' : '' }}>
                        <i class="tim-icons icon-paper"></i>
                        <span class="nav-link-text">Registro académico</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse {{ $section == 'inventory' ? 'show' : '' }}" id="inventory">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'istats') class="active " @endif>
                                <a href="{{ route('inventory.stats') }}">
                                    <i class="tim-icons icon-chart-pie-36"></i>
                                    <p>Estatísticas</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'routes') class="active " @endif>
                                <a href="{{ route('routes.index') }}">
                                    <i class="tim-icons icon-credit-card"></i>
                                    <p>Propinas</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'estudantes') class="active " @endif>
                                <a href="{{ route('estudantes.index') }}">
                                    <i class="tim-icons icon-badge"></i>
                                    <p>Estudantes</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'disciplinas') class="active " @endif>
                                <a href="{{ route('disciplinas.index') }}">
                                    <i class="tim-icons icon-book-bookmark"></i>
                                    <p>Disciplinas</p>
                                </a>
                            </li>

                            <li @if ($pageSlug == 'inscricoes') class="active " @endif>
                                <a href="{{ route('inscricoes.index') }}">
                                    <i class="tim-icons icon-vector"></i>
                                    <p>Inscrições</p>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>


                    <div class="collapse {{ $section == 'transactions' ? 'show' : '' }}" id="transactions">
                        <ul class="nav pl-4">
                            {{--  <li @if ($pageSlug == 'tstats') class="active " @endif>
                                <a href="{{ route('transactions.stats') }}">
                                    <i class="tim-icons icon-chart-pie-36"></i>
                                    <p>Relatórios</p>
                                </a>
                            </li>  --}}
                            <li @if ($pageSlug == 'transactions') class="disabled " @endif>


                            </li>




                </li>

        </ul>
    </div>
    </li>
    @endif






    </ul>
</div>
</div>

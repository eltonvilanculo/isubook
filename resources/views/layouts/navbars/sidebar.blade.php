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
                        <span class="nav-link-text">Invetário</span>
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
                            <li @if ($pageSlug == 'categories') class="active " @endif>
                                <a href="{{ route('categories.index') }}">
                                    <i class="tim-icons icon-components"></i>
                                    <p>Categorias</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'products') class="active " @endif>
                                <a href="{{ route('products.index') }}">
                                    <i class="tim-icons icon-bag-16"></i>
                                    <p>Livraria</p>
                                </a>
                            </li>

               <li @if ($pageSlug == 'sales') class="active " @endif>
                                <a href="{{ route('sales.index') }}">
                                    <i class="tim-icons icon-bag-16"></i>
                                    <p>Pedidos</p>
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


    <li>
        <a data-toggle="collapse" href="#users" {{ $section == 'users' ? 'aria-expanded=true' : '' }}>
            <i class="tim-icons icon-badge"></i>
            <span class="nav-link-text">Utilizadores</span>
            <b class="caret mt-1"></b>
        </a>

        <div class="collapse {{ $section == 'users' ? 'aria-expanded=true' : '' }}" id="users">
            <ul class="nav pl-4">
                <li @if ($pageSlug == 'profile') class="active " @endif>
                    <a href="{{ route('profile.edit') }}">
                        <i class="tim-icons icon-badge"></i>
                        <p>Meu perfil</p>
                    </a>
                </li>
                 @if(Auth::user()->type==0)
                <li @if ($pageSlug == 'users-list') class="active " @endif>
                    <a href="{{ route('users.index') }}">
                        <i class="tim-icons icon-notes"></i>
                        <p>Gestão de utilizadores</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'users-create') class="active " @endif>
                    <a href="{{ route('users.create') }}">
                        <i class="tim-icons icon-simple-add"></i>
                        <p>Novo utilizador</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </li>




    </ul>
</div>
</div>

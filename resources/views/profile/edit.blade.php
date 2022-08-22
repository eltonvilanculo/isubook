@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile', 'section' => 'users'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Editar Perfil</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>Nome</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nome" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">Senha</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>Senha atual</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="Current password" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>Nova Senha</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="New password" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>Confirme a nova senha</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a nova senha" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">Mudar senha</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user bg-primary">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('assets/img/default-avatar.png') }}" alt="">
                                <h5 class="title text-white">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="Descrição"></p>
                        </div>
                    </p>
                    <div class="card-description"></div>
                </div>

                {{-- <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

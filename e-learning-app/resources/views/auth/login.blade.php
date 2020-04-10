@extends('layouts.app')
@section('content')
    <!--
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
            {{ trans('global.login') }}
        </p>

        @if(session('message'))
            <p class="alert alert-info">
                {{ session('message') }}
            </p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" name="email" class="form-control" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" name="password" class="form-control" required placeholder="{{ trans('global.login_password') }}">

                @if($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label><input type="checkbox" name="remember"> {{ trans('global.remember_me') }}</label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ trans('global.login') }}
                    </button>
                </div>
            </div>
        </form>

        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                Mot de passe oublié
            </a><br>
        @endif


    </div>
</div>-->
<head>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet" />
</head>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Créer un compte</h1>
            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nom">

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mot de passe">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer mot de passe">
            <div style="margin: 10px;">
                <span><input type="radio" name="role" value="3" >&nbsp;&nbsp;&nbsp;&nbsp;Etudiant</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span> <input type="radio" name="role" value="2" >&nbsp;&nbsp;&nbsp;&nbsp;Enseignant<span></div>
            <button>S'inscrire</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        @if(session('message'))
            <p>
                {{ session('message') }}
            </p>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1 style="margin: 10px">Connexion</h1>

            <input id="email" type="email" name="email" required autocomplete="email" autofocus placeholder="Email" value="{{ old('email', null) }}"/>

            @if($errors->has('email'))
                <p class="help-block">
                    {{ $errors->first('email') }}
                </p>
            @endif


            <input id="password" type="password" name="password" required placeholder="Mot de passe" />

            @if($errors->has('password'))
                <p class="help-block">
                    {{ $errors->first('password') }}
                </p>
            @endif

            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            @endif
                    <div class="checkbox icheck">
                        <label><input type="checkbox" name="remember"> Se souvenir de moi</label>
                    </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back !</h1>
                <p>Vous êtes déja un membre? veuillez s'authetifier pour rester connecter avec nous!</p>
                <button class="ghost" id="signIn">Se connecter</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Bienvenue sur Dirassati Educ !</h1>
                <p>Si vous n'êtes pas encore un membre, Inscrivez-vous pour nous rejoindre !</p>
                <button class="ghost" id="signUp"><a href="{{route('register')}}" style="text-decoration: none; color: white">S'inscrire</a></button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>


@endsection



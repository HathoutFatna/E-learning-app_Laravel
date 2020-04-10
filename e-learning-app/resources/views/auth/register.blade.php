@extends('layouts.app')

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
<head>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet" />
    <style>.etud-inline{display: inline-block;}</style>
</head>
<!-- kjhgfdghjkjhgfdfghjkkjhgfghhjkjhgfghjklkjbvcdfgyuioplkjnbvfgyhui-->
<div class="container right-panel-active" id="container">
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
            <span><input type="radio" name="role" value="3" >&nbsp;&nbsp;Etudiant</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span> <input type="radio" name="role" value="2" >&nbsp;&nbsp;Enseignant<span></div>
            <button>S'inscrire</button>
        </form>
    </div>
    <!-- kjhgfdghjkjhgfdfghjkkjhgfghhjkjhgfghjklkjbvcdfgyuioplkjnbvfgyhui-->
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


            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mot de passe">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

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
           <button type="submit"> Se connecter</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back !</h1>
                <p>Vous êtes déja un membre? veuillez s'authetifier pour rester connecter avec nous!</p>
                <button class="ghost" id="signIn"><a href="{{route('login')}}" style="text-decoration: none; color: white">Se connecter</a></button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Bienvenue sur Dirassati Educ !</h1>
                <p>Si vous n'êtes pas encore un membre, Inscrivez-vous pour nous rejoindre !</p>
                <button class="ghost " id="signUp">S'inscrire</button>
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




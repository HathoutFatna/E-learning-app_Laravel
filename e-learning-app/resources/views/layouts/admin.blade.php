<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <title>Dirassati </title>
    <link rel="icon" href="{{ URL::asset('img/fav.png') }}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
<div class="wrapper">
    <div class="sidebar">
        <img src="{{URL::asset('/img/logo-noir.png')}}" alt="profile Pic" class="logo-img">
        <ul>
            <li class="item">
                <a class="btn" href="{{route('home.index')}}">
                    <i class="fa-fw fas fa-chalkboard-teacher">

                    </i>
                    {{ trans('Dirassati Home') }}
                </a>
            </li>
            <li class="item">
                <a class="btn" href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('Tableau de bord') }}
                </a>
            </li>

            @can('user_management_access')
                <li class="item" id="gestion_users">
                    <a class ="btn "href="#gestion_users">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>Gestion Des Utilisateurs</span>

                    </a>
                    <div class="smenu">
                        @can('role_access')
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">
                                    </i>
                                    <span>{{ trans('Rôles') }}</span>
                                </a>
                        @endcan
                        @can('user_access')
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">
                                    </i>
                                    <span>{{ trans('Utilisateurs') }}</span>
                                </a>
                        @endcan
                    </div>
                </li>
            @endcan

            @can('gestion_des_cour_access')
                <li class="item" id="gestion_cours">
                    <a href="#gestion_cours" class="btn">
                        <i class="fa-fw fas fa-graduation-cap">
                        </i>
                        <span>{{ trans('Gestion Des Cours') }}</span>
                    </a>
            <div class="smenu">
                        @can('cour_access')
                                <a href="{{ route("admin.cours.index") }}">
                                    <i class="fa-fw fas fa-chalkboard-teacher">

                                    </i>
                                    <span>{{ trans('Cours') }}</span>
                                </a>
                        @endcan
                        @can('chapitre_access')
                                <a href="{{ route("admin.chapitres.index") }}">
                                    <i class="fa-fw fas fa-book">
                                    </i>
                                    <span>{{ trans('Chapitres') }}</span>
                                </a>
                        @endcan
                        @can('lecon_access')
                                <a href="{{ route("admin.lecons.index") }}">
                                    <i class="fa-fw fas fa-cogs">
                                    </i>
                                    <span>{{ trans('Leçons') }}</span>
                                </a>
                        @endcan
                                <a href="{{ route("admin.categories.index") }}">
                                    <i class="fa-fw fas fa-briefcase">
                                    </i>
                                    <span>{{ trans('Catégories') }}</span>
                                </a>

            </div>
                </li>
            @endcan
            @can('gestion_des_evaluation_access')
                <li class="item" id="gestion_ev">
                    <a href="#gestion_ev" class="btn">
                        <i class="fa-fw fas fa-check-double">
                        </i>
                        <span>{{ trans('Gestion Des Evaluations') }}</span>
                    </a>
                    <div class="smenu">
                        @can('question_access')
                                <a href="{{ route("admin.questions.index") }}">
                                    <i class="fa-fw fas fa-question">
                                    </i>
                                    <span>{{ trans('Questions') }}</span>
                                </a>
                        @endcan
                        @can('quiz_access')
                                <a href="{{ route("admin.quizzes.index") }}">
                                    <i class="fa-fw fas fa-pencil-ruler">
                                    </i>
                                    <span>{{ trans('Quiz') }}</span>
                                </a>
                        @endcan
                    </div>
                </li>
            @endcan

            <li class="item">
                <a href="#" class="btn" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    Déconnexion
                </a>
            </li>
        </ul>
    </div>
    <div class="main_content">
        <div class="header">Bienvenue {{ Auth::user()-> name }}</div>
        @yield('content')
    </div>
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')
</body>
</html>

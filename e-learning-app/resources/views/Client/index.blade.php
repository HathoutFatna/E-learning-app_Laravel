<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ URL::asset('img/fav.png') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/latif/index.css') }}">
    <title>Dirassati</title>
    <style>
        #c{
            float:right;

        }
        .dropbtn {
            background-color: white;
            color: black;
            padding: 5px;
            font-size: 15px;
            border: none;
            margin-:0;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            float:right;
            margin:20px 20px 0 20px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;

        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;

        }

        .dropdown-content a:hover {background-color: #ddd;}

        .dropdown:hover .dropdown-content {display: block;float:right;margin-right:50px;}

        .dropdown:hover .dropbtn {box-shadow: -4px -4px 50px  white, 4px 4px 50px 0 white;}
    </style>

</head>
<body>

    <header>
        <!--
        <div class="fog text middle" style="margin-left:1% ;">
            <span>D</span>
            <span class="h">i</span>
            <span class="h">r</span>
            <span class="h">a</span>
            <span class="h">s</span>
            <span class="h">s</span>
            <span class="h">a</span>
            <span class="h">t</span>
            <span class="h">i</span>
            <span>E</span>
            <span class="h">d</span>
            <span class="h">u</span>
            <span class="h">c</span>
        </div>
-->
        <span><a href="{{route('home.index')}}" > <img src="https://media.licdn.com/dms/image/C560BAQE4pLfDxRsufg/company-logo_200_200/0?e=2159024400&v=beta&t=pI-c0INoBWjH-PhoMQHJvkoovqV0Ru5iSnVT0prXDJE" alt="Dirassati" style="border-radius:20px;height:60px;width:60px;padding:5px;position:absolute;"></a></span>
        <nav id="nav" class="fog">
            <a href="{{ route ('cours.index') }}" class="a1">Cours</a>
            <a href="" class="a1">Professeurs</a>
            <a href="mailto:Dirassati@gmail.com" class="a1">Contact</a>
        </nav>
        <!--<span class="fog" id="search">
            <label for="search" style="color:#f1f3f6">recherche</label>
            <input id="ins" type="text">
        </span>-->
        <span class="wrap">
            <form action="/search" method="POST" role="search">
               {{ csrf_field() }}
            <div class="search">
                <input type="text" class="searchTerm" name="q" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
                </button>
            </div>
            </form>
        </span>
        @if (Auth::check())
        <!--<span style="margin-left: 405px">
            Logged in as {{ Auth::user()->email }} , Bienvenue {{ Auth::user()-> name }}
            <a href="{{ route ('student.index') }}">Mes Cours</a>
            @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                <a href="{{ route ('admin.home') }}">Tableau de bord</a>

                @endif
            <a href="#" class="btn" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>-->
            <h4 style="display:inline;float:right;margin-right:10px;text-transform: capitalize;color:white;">bienvenue {{ Auth::user()-> name }}</h4>
            <div class="dropdown fog">
                <button class="dropbtn"><i class="fa fa-bars"></i></button>
                <div class="dropdown-content">
                    <a href="{{ route ('student.index') }}">Mes Cours</a>
                    @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                        <a href="{{ route ('admin.home') }}">Tableau de bord</a>

                    @endif
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Déconnexion</a>

                </div>
            </div>
             <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
        </span>
        @else
        <span id="b" class="fog">
            <button id="bt1" ><a href="{{route('login')}}" style="text-decoration: none; color: #0E3368">Se connecter</a></button>
            <button id="bt2"><a href="{{route('register')}}" style="text-decoration: none; color: #0E3368">S'inscrire</a></button>
        </span>
            @endif
    </header>
    <div id="espace" style="height:70px;width:100%;background:;position:relative;"></div>

    @yield('home')
    @yield('course')
    @yield('SolutionTest')

    @yield('cour_detail')
    @yield('lecon_detail')
    <footer id="footer">
				<div class="inner">
					<div class="content">
						<section>
                        <img src="{{URL::asset('/img/logo.png')}}" alt="Dirassati" height="80px" width="200px" style="float:left;">
							<h3>A propos de Dirassati</h3>
							<p>Dirassati est une école en ligne offrant des parcours diplômants et professionnalisants à plus de trois millions d'étudiants chaque mois à travers le monde. Quelle que soit votre ambition, Dirassati peut vous aider à bâtir votre avenir.</p>
						</section>
						<section>
							<h4>Dirassati</h4>
							<ul class="alt">
								<li><a href="{{ route ('cours.index') }}">Cours</a></li>
								<li><a href="#">Professeurs</a></li>
								<li><a href="#">Catégories</a></li>
								<li><a href="#">Forums</a></li>
							</ul>
						</section>
						<section>
							<h4>N'hesitez pas à nous suivre!</h4>
							<ul class="plain">
								<li><i class="fa fa-twitter" style="font-size:20px;color:white;"></i>&nbsp;&nbsp;<a href="#">Twitter</a></li>
								<li><i class="fa fa-facebook" style="font-size:20px;color:white;"></i>&nbsp;&nbsp;<a href="#">Facebook</a></li>
								<li><i class="fa fa-instagram" style="font-size:20px;color:white;"></i>&nbsp;&nbsp;<a href="#">Instagram</a></li>
								<li><i class="fa fa-github" style="font-size:20px;color:white;"></i>&nbsp;&nbsp;<a href="#">Github</a></li>
							</ul>
                        </section>

                    </div>

					<div class="copyright">

						&copy; Dirassati Educ.
					</div>
				</div>
	</footer>
</body>
</html>

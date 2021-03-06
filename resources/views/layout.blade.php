<!DOCTYPE html>
<html lang="en">

<head>


<title>Gestor Finanças</title>
<link rel="stylesheet" href="/css/estilos.css">
<script src="{{ asset('js/app.js') }}" defer></script>
<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


</head>

<body>

	<header>
        <div id="logo">
           <!-- <img src="/img/logo.png" alt="Logo"> -->
        </div>
        <h1>Gestor Finanças</h1>

        <div class="avatar-area">
             @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <li class="nav-item dropdown">
                            <!--<a href="{{ url('/') }}">{{Auth::user()->name}}</a>-->
                            <a>{{Auth::user()->name}}</a>
                            <img src="{{Auth::user()->foto ? asset('storage/fotos/' . Auth::user()->foto) : asset('img/default_img.png') }}">
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
           <!-- <span>User Anonimo</span>-->
           <!-- <img src="/img/default_img.png" alt="User img">-->
        </div>
        <div id="menuIcon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </header>

    <div class="container">
    	<nav>
            <ul>
            	<!--no <li> inserir class="{{Route::currentRouteName() == 'home' ? 'sel' : ''}}" para ver o que foi selecionado -->

                <li>
                    <i class="fas fa-info-circle"></i>
                    <a href="{{ route('homepage') }}">Home Page</a>
                </li>
                <li>
                    <i class="fas fa-box"></i>
                    <a href="{{ route('users') }}">Users</a>
                </li>
                <li>
                    <i class="far fa-file"></i>
                    <a href={{route('contas')}}>Contas</a>
                </li>
                <li>
                    <i class="fab fa-wpforms"></i>
                    <a href="{{route('perfil')}}">Perfil</a>
                </li>
                <li>
                    <i class="fab fa-wpforms"></i>
                    <a href="{{route('estatistica')}}">Estatisticas</a>
                </li>
            </ul>
        </nav>
        <section id="main">
        	<div class="left-content">
                 @yield('content')
        	</div>
        	<footer>
                <p>
                    © <a> Gestor Finanças</a>
                </p>
            </footer>
        </section>

    </div>




</body>



</html>

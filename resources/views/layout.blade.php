<!DOCTYPE html>
<html lang="en">

<head>
	

<title>Gestor Finanças</title>
<link rel="stylesheet" href="/css/estilos.css">

</head>

<body>

	<header>
        <div id="logo">
           <!-- <img src="/img/logo.png" alt="Logo"> -->
        </div>
        <h1>Gestor Finanças</h1>

        <div class="avatar-area">
            <span>User Anonimo</span>
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
                    
                    <a>Home Page</a>
                </li>
                <li>
                    <i class="fas fa-box"></i>
                    <a>Opção 2</a>
                </li>
                <li>
                    <i class="far fa-file"></i>
                    <a>Opção 3</a>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <a>Opção 4</a>
                </li>
                <li>
                    <i class="fab fa-wpforms"></i>
                    <a>Opção 5</a>
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
<header>
    <div class="navbar navbar-default" role="navigation">
        <div class="container" style="display: flex">
            <div class="logo" style="display: flex">
                <img style="width: 70px;height: 70px" src="{{asset('img/logo.jpg')}}">
                <a class="navbar-brand" href="{{route('home')}}">Padel Sport</a>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                    <li><a href="#">Sobre nosotros</a></li>
                    <li><a href="{{route('paddleCourt.index')}}">Pistas</a></li>
                    <li><a href="#">Precios</a></li>
                    <li><a href="#">Valoraciones</a></li>
                    <li><a href="#">Contacto</a></li>
                    @guest
                        <li><a href="{{route('login')}}">Entrar</a></li>
                    @endguest
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</header>
<!-- end Header -->

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
                    <li class="active"><a href="{{route('home')}}">Inicio</a></li>
                    <li><a href="{{route('paddleCourt.index')}}">Pistas</a></li>
                    <li><a href="{{route('rules')}}">Reglas</a></li>
                    <li><a href="{{route('contact.index')}}">Contacto</a></li>
                    @guest
                        <li><a href="{{route('login')}}">Entrar</a></li>
                    @endguest
                    @auth
                        @if(\Illuminate\Support\Facades\Auth::user()->rol_id==2)
                            <li><a href="{{route('admin.dashboard')}}">Administrar</a></li>
                        @else
                        <li><a href="{{route('profile.edit')}}">Perfil</a></li>
                        @endif
                        <li><a class="dropdown-item" href="#" onclick="
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                                " >Cerrar sesion</a></li>
                        <form id="logout-form" action="{{route('logout')}}" method="post">
                            @csrf
                        </form>
                    @endauth
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</header>
<!-- end Header -->

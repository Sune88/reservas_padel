<!-- Footer -->
<section class="footer">
    <div class="footer-section container">
        <div class="item-footer col-sm-6 col-xs-12 col-md-4" style="display: grid">
            <a class="navbar-logobrand" style="text-align: center;" href="{{route('home')}}">Padel Sport</a>
            <img style="width: 100px;height: 100px;margin:auto" src="{{asset('img/logo.jpg')}}">
        </div>
        <div class="item-footer col-sm-6 col-xs-12 col-md-4">
            <h4 class="footer-title">Enlaces de interés</h4>
            <ul class="gold" >
                <li><a style="color: white" href="{{route('rules')}}">Reglas</a></li>
                <li><a  style="color: white" href="{{route('paddleCourt.index')}}">Pistas</a></li>
                <li><a style="color: white" href="{{route('contact.index')}}">Contacto</a></li>
                @auth
                    <li><a style="color: white" href="{{route('profile.edit')}}">Perfil</a></li>
                @elseguest
                    <li><a style="color: white" href="{{route('login')}}">Entrar</a></li>
                @endauth
            </ul>
        </div>
        <div class="item-footer col-sm-6 col-xs-12 col-md-4" >
            <h4 class="footer-title footer-tags">Contacto</h4>
            <p style="color: white!important">C\Villa de Rota nº 15 - 6660011000</p>
            <p style="color: white!important">Horario: 09:00 - 21:00 </p>
        </div>
    </div>
</section>
<section class="footer-bottom">
    <p class="text-center copyright-text">&copy;PadelSport - All Rights Reserved</p>
</section>

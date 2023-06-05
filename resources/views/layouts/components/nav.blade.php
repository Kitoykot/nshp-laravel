<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('main') }}"><span class="largeN">N</span>aruto`s <span class="largeS">S</span>tore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main') }}">Поиск</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create-sale') }}">Создать объявление</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my-sales') }}">Мои объявления</a>
                    </li>
                @endauth
            </ul>

            @guest
                <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                <a class="nav-link" href="{{ route('login') }}">Войти</a>
            @endguest

            @auth
                <a class="nav-item">{{Auth::user()->name}}</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти
                </a>
            @endauth

        </div>
    </div>
</nav>

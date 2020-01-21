<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="/">{{ config('app.name', 'Time Report') }}</a>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                    @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">Пользователи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('reports.all')}}">Отчеты</a>
                        </li>
                    @endrole

                    @role('user')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('reports.index')}}">Отчеты</a>
                        </li>
                    @endrole

                    <div class="dropdown ml-0 ml-lg-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</header>
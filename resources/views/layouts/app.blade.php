<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role == 'Администратор')
                                        <a href="{{ route('configs.index') }}" class="dropdown-item">
                                            Параметры
                                        </a>
                                        <a href="{{ route('pay_variables.index') }}" class="dropdown-item">
                                            Способы пополнения
                                        </a>
                                        <a href="{{ route('put_money.user_puts') }}" class="dropdown-item">
                                            Заявки на пополнение баланса
                                        </a>
                                        <a href="{{ route('out_money.user_outs') }}" class="dropdown-item">
                                            Заявки на снятие средств
                                        </a>
                                    @elseif(Auth::user()->role == 'Пользователь')
                                        <a href="{{ route('put_money.index') }}" class="dropdown-item">
                                            Заявки на пополнение баланса
                                        </a>
                                        <a href="{{ route('out_money.index') }}" class="dropdown-item">
                                            Заявки на снятие средств
                                        </a>
                                    @endif
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
            <h1 class="page-header h3">@yield('header')</h1>
                <div class="row">
                    @if(Auth::check())
                        <div class="col-3">
                            <div class="col-12 name">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="col-12 balance">
                                Баланс: $ {{ Auth::user()->balance }}
                            </div>
                            <div class="col-12 balance-actions">
                                <a href="#">Пополнить</a> / <a href="#">Вывести</a>
                            </div>
                            <div class="col-12 game-list-players-info">
                                <h5>Список игроков в текущей игре</h5>
                                <div class="players-list col-12">
                                    @php
                                    //use App\Game;
                                    //use App\Models\Claim;

                                    $game = App\Game::where('beginning', '0')
                                        ->first();

                                    if(!empty($game))
                                    {
                                        $claims = App\Models\Claim::where('game_id', $game->id)
                                            ->limit(15)
                                            ->get();

                                        $claims_list = '<ul>';

                                        foreach($claims as $key => $value)
                                        {
                                            $claims_list .= '<li>'.$value->user()->name.'</li>';
                                        }

                                        $claims_list .= '</ul>';

                                        echo $claims_list;

                                    }
                                    @endphp
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="@if(Auth::check()) col-9 @else col-12 @endif">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

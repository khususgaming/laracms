<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Baca baca makin asyik - {{ config('app.name') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
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
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('Jadi Penulis') }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        @if (Route::has('register'))
                                            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endif
                                    </div>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
                                        <a class="dropdown-item" href="{{ route('profile.index') }}">{{ __('Profile') }}</a>
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
                    <div class="row">
                        @php $inc_post = 0; @endphp
                        @foreach ($posts as $post)
                            @if ($post->status == 1)
                                @php $inc_post++; @endphp
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <a href="{{ URL::to('/post/'.$post->id) }}">
                                            <img class="card-img-top" src="{{ $post->thumbnail }}" alt="{{ $post->title }}">
                                        </a>
                                        <div class="card-body">
                                            <a href="{{ URL::to('/post/'.$post->id) }}">
                                                <h5 class="card-title">{{ $post->title }}</h5>
                                            </a>
                                            <p class="card-text">{{ Str::words(strip_tags($post->content), 10) }}</p>
                                            <a href="{{ URL::to('/post/'.$post->id) }}" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($inc_post == 0)
                            <div class="col-md-12 text-center">
                                Artikel tidak tersedia
                            </div>
                        @endif
                    </div>
                    @if ($posts->lastPage() > 1)
                        <div class="row justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </main>
            <footer class="footer-copyright text-center py-3">
                <hr class="w-75">
                © 2020 Copyright: {{ config('app.name') }}
            </footer>
        </div>
    </body>
</html>

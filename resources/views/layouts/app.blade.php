<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/login.scss') }}" rel="stylesheet">
    <link href="{{ asset('/css/home.scss') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/layout.scss"/>

</head>
<body>

        <nav>
            <div class="logo">
                <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <input type="checkbox" id="checkbox">
            <label for="checkbox" id="icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </label>
            <ul>
                @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @if (Route::has('register'))
                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @endif
                @else
                <li><a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('home')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a></li>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf

                </form>
            </ul>
           @endguest
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('updated'))
    <script>
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Your record has been updated',
    showConfirmButton: false,
    timer: 1500
    })
    </script>
@endif

@if (session('added'))
<script>
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Record added successfully',
    showConfirmButton: false,
    timer: 1500
    })
    </script>
@endif

@if (session('delete'))
<script>
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Record deleted successfully',
    showConfirmButton: false,
    timer: 1500
    })
    </script>
@endif





</html>

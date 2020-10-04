<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{URL::asset('/')}}" target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Auction Beast') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Page Preloader End -->
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="img/logo.png" alt=""></div>
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
                            <!-- <li class="nav-item dropdown"> -->
                           <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> -->
                                    <!-- Load icon library -->
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                    <!-- The form -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/profile/{{Auth::user()->id}}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('view-form').submit();">
                                            {{ Auth::user()->username }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/search"
                                        onclick="event.preventDefault();
                                                        document.getElementById('search-form').submit();">
                                            {{ __('Search') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="/sell"
                                       onclick="event.preventDefault();
                                                     document.getElementById('sell-form').submit();">
                                        {{ __('List an Item') }}
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/profile/{{Auth::user()->id}}/edit"
                                        onclick="event.preventDefault();
                                                        document.getElementById('edit-form').submit();">
                                            {{ __('Edit Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="/topup/{{Auth::user()->id}}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('topup-form').submit();">
                                            Wallet Balance : Rp.{{number_format(Auth::user()->wallet, 0)}}
                                        </a>
                                    </li>
                                    <li class="nav-item2">
                                        <form action="/search" method="get" enctype="multipart/form-data" class="contact-form2" style="oneline">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                            <input id="search" type="text" name="search" value="{{ old('search') }}" autocomplete="search" autofocus> 
                                        </form>
                                    </li>
                                    <form id="search-form" action="/search" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="sell-form" action="/sell" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="edit-form" action="/profile/{{Auth::user()->id}}/edit" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="view-form" action="/profile/{{Auth::user()->id}}" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="topup-form" action="/topup/{{Auth::user()->id}}" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                <!-- </div> -->
                            <!-- </li> -->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Footer Section Begin -->
    <!-- <footer class="footer-section spad"> -->
        <div class="social-links-warp">
			<div class="container">
				<div class="social-links">
                    <!-- asdasd link ke sosmed, yg ga ad delete aj -->
					<a href="https://www.instagram.com/auction_beast/" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
					<a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
					<a href="https://www.facebook.com/Auction-beast-104903374560302/" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
					<a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
					<a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
					<a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
				</div>
			</div>
		</div>
    <!-- </footer> -->
    <!-- Footer Section End -->
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>

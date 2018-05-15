<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    {{--<link rel="stylesheet" href="css/bootstrap-iso.css" />--}}

    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>
    <link href="/css/main.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode( [
		    'csrfToken' => csrf_token(),
	    ] ); ?>
    </script>
</head>
<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{config('app.name', 'eDieťa')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="nav navbar-nav ml-auto">
                @if (Auth::guest())
                    @if(Config::get('app.default_locale') == '')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                @lang('app.language') ({{ Config::get('languages')[App::getLocale()] }})
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach(Config::get('languages') as $lang => $language)
                                    <a class="dropdown-item"
                                       href="{{ route('lang.switch', $lang) }}">{{ $language }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">@lang('app.login')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">@lang('app.register')</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            @if(Auth::user()->hasRole('admin'))
                                <a class="dropdown-item" href="{{ url('/admin') }}">
                                    Dashboard
                                </a>
                            @endif
                            @if(Auth::user()->hasRole('doctor'))
                                <a class="dropdown-item" href="{{ url('/surgery',[Auth::user()->workplace->id]) }}">
                                    @lang('surgery.surgery')
                                </a>
                            @endif
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <form id="lang-en-form" action="{{ url('/en') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="locale" value="en">
        </form>
        <form id="lang-sk-form" action="{{ url('/sk') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="locale" value="sk">
        </form>
    </div>
</nav>
@yield('content')

<!--Footer-->
<footer class="page-footer font-small stylish-color-dark pt-4 mt-4">

    <!--Footer Links-->
    <div class="container text-center text-md-left">

        <!-- Footer links -->
        <div class="row text-center text-md-left mt-3 pb-3">

            <!--First column-->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Company name</h6>
                <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit.</p>
            </div>
            <!--/.First column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Second column-->
        {{--<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">--}}
        {{--<h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>--}}
        {{--<p><a href="#!">MDBootstrap</a></p>--}}
        {{--<p><a href="#!">MDWordPress</a></p>--}}
        {{--<p><a href="#!">BrandFlow</a></p>--}}
        {{--<p><a href="#!">Bootstrap Angular</a></p>--}}
        {{--</div>--}}
            <!--/.Second column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Third column-->
            <div class="col-md-5 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
                {{--<p><a href="#!">Your Account</a></p>--}}
                {{--<p><a href="#!">Become an Affiliate</a></p>--}}
                @if(!Auth::guest())
                    <p><a href="{{ url('/new_surgery') }}">@lang('app.newSurgery')</a></p>
                @endif
                <p><a href="#!">Help</a></p>
            </div>
            <!--/.Third column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Fourth column-->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                <p><i class="fa fa-home mr-3"></i> New York, NY 10012, US</p>
                <p><i class="fa fa-envelope mr-3"></i> info@gmail.com</p>
                <p><i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
                <p><i class="fa fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!--/.Fourth column-->

        </div>
        <!-- Footer links -->

        <hr>

        <div class="row py-3 d-flex align-items-center">

            <!--Grid column-->
            <div class="col-md-8 col-lg-8">

                <!--Copyright-->
                <p class="text-center text-md-left grey-text">© 2018 Copyright: <a
                            href="https://mdbootstrap.com/material-design-for-bootstrap/"><strong>
                            MDBootstrap.com</strong></a></p>
                <!--/.Copyright-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 col-lg-4 ml-lg-0">

                <!--Social buttons-->
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i
                                        class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i
                                        class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i
                                        class="fa fa-google-plus"></i></a></li>
                        <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1"><i
                                        class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <!--/.Social buttons-->

            </div>
            <!--Grid column-->

        </div>

    </div>

</footer>
<!--/.Footer-->


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/main.js"></script>
<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

<script type="text/javascript">
    var bmiData = null;
    @if(isset($bmiChartData))
        bmiData = {!!  json_encode($bmiChartData)  !!};
    @endif
</script>
<script rel="js/main.js"></script>
</body>
</html>

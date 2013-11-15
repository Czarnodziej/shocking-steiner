<!DOCTYPE HTML>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,	user-scalable=no">
	<title>CRUD</title>
	@section('head')
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext' rel='stylesheet'>
	<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<script src="{{ asset('assets/js/vendor/modernizr-2.6.2.min.js') }}"></script>
	@show
</head>
<body>
<!--[if lt IE 8]>
  <p class="chromeframe">Używasz <strong>prehistorycznej</strong> przeglądarki, co stwarza <strong>realne zagrożenie dla Ciebie </strong> i wszystkich informacji jakie zamieszczasz w sieci.
  Ochoczo zalecam <a href="http://browsehappy.com/">aktualizację</a>
  lub <a href="http://www.google.com/chromeframe/?redirect=true">aktywację Google Chrome Frame</a>.
  Aktualna przeglądarka to podstawa prawidłowego wyświetlania stron i bezpiecznego korzystania z internetu.</p>
<![endif]-->

  @section('topbar_nav')
  <div id="gora-kontener">
    <nav id="topbar">
        @if (Sentry::check())
        <span>
          <a href="{{ URL::route('użytkownik.teksty.index') }}">Edycja tekstów</a>
          <a href="{{ URL::route('article.list') }}">Wszystkie teksty</a>
        </span>
        <span id="login">{{Sentry::getUser()->email}}
        <a href="{{ URL::route('user.logout') }}">Wyloguj</a>
        </span>
        @else
        <a href="{{ URL::route('article.list') }}">Teksty</a>
        <span id="login">
        <a href="{{ URL::route('user.login') }}">Logowanie</a>
        <a href="{{ URL::route('user.register') }}">Rejestracja</a>
        </span>
        @endif
    </nav>
  </div>
  @show
    <div id="main-container">
  	<article>
    <noscript>
      <p>Strona wymaga przeglądarki z włączoną obsługą JavaScript.</p>
    </noscript>
  		<!--content start-->
  		@yield('main_content')
  	</article>
  	</div>
  	@section('bottom_scripts')
	<!--[if lt IE 9]>
	<script src="{{ asset('assets/js/vendor/respond.min.js') }}"></script>
	<![endif]-->
	@show
</body>
</html>
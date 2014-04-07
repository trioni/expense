<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Lang::get('app.title') }} - {{ $titleSlug }}</title>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Neuton:700' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        var el = document.getElementsByTagName('html')[0];
        el.className = el.className.replace('no-js', 'js');
    </script>
    <link href="{{ asset('styles/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('headscripts','')
</head>
<body>

<div class="container">
    <div class="header">
        @include('partials.navigation')
        <h3 class="text-muted">{{ Lang::get('app.title'); }}</h3>
    </div>

    @include('partials.messages')

    <div class="row">
        <div class="col-md-12">
            @yield('content','Default content')
        </div>
    </div>

    <div class="footer">
        @include('partials.footer')
    </div>

</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('js/dist/Expenses.min.js') }}"></script>
</body>
</html>

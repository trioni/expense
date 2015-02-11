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

    <script>
        var app = app || {};
        app.csrf_token = '{{ csrf_token() }}';
        @yield('headscripts','')
    </script>
</head>
@if ( Config::get('app.angular') )
    <body ng-app="expenses">
@else
<body>
@endif

@if ( Config::get('app.angular') )
    <messageview></messageview>
@endif

<div class="container">
    <div class="header">
        @include('partials.navigation')
        <h3 class="text-muted">{{ Lang::get('app.title'); }}</h3>
    </div>

    @include('partials.messages')

    <div class="row" >
        <div class="col-md-12">
            @yield('content','Default content')
        </div>
    </div>

    <div class="footer">
        @include('partials.footer')
    </div>

</div>

@if ( Config::get('app.angular') )
<script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
<script src="{{ asset('bower_components/angular-route/angular-route.js') }}"></script>
<script src="{{ asset('js/app/app.js') }}"></script>
@else
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('js/dist/Expenses.min.js') }}"></script>
@endif
</body>
</html>

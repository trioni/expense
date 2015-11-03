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
        var be = {};
        @if (isset($be))
        be = {{$be}};
        @endif
        be.csrf_token = '{{ csrf_token() }}';
        @yield('headscripts','')
    </script>
</head>

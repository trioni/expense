<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
@include('partials.htmlhead')
<body ng-app="expenses">
    <messageview></messageview>

    <div class="container">
        <div class="header">
            <main-navigation></main-navigation>
            <svg id="logo" title="{{ Lang::get('app.title') }}" alt="{{ Lang::get('app.title') }}" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><path d="M18.873 23.38c-.04-.372-.244-.778-.234-1.108.973.7 1.558 1.715 1.575 3.21.002.194-.02.393-.05.592 0 0 .48 2.208 3.656 2 1.553-.103 3.03-.84 3.03-.84-.518-2.9-2.612-6.827-2.374-10.1.024-.323.072-.75.175-1.106.093-.317.37-.603.35-.935-1.953.93-3.405 2.658-3.326 5.43-1.668-1.85-3.43-4.355-3.62-7.765-.105-1.914.44-3.142.876-4.61h-.175c-2.807 1.712-4.435 4.978-3.736 9.396.163 1.036.607 2.165.583 3.327-.027 1.272-.384 2.21-.934 3.15.515-2.85-.282-5.886-2.394-6.827.24 2.154.39 3.904-.35 5.37-.18.357-.448.667-.642.99-.588.985-1.073 2.167-1.284 3.62v1.4c.477 3.054 2.644 4.712 5.487 5.546.376.107.83.382 1.226.173-1.008-.606-1.914-1.3-2.043-2.626-.204-2.09 1.567-3.86.992-6.012.72.453 1.35 1.29 1.11 2.51.344.062.553-.376.758-.643.73-.948 1.532-2.297 1.343-4.14zM18.706 27.048v12.938c7.1 6.47 14.197-6.47 21.294 0V27.048c-7.1-6.47-14.197 6.47-21.294 0zM29.354 38.3c-2.643 1.308-4.783-.353-4.783-3.044 0-2.59 2.142-5.215 4.784-6.52 2.643-1.31 4.78.352 4.78 3.042 0 2.59-2.14 5.214-4.78 6.522zM30.865 32.76c-.23-.06-.666-.037-1.31.076V30.81c.38-.16.66-.14.835.064.094.11.15.27.17.47.242-.105.486-.21.73-.31-.016-.464-.17-.78-.464-.938-.296-.16-.72-.135-1.27.077v-.544l-.397.18v.552c-.558.262-.99.625-1.3 1.097s-.465.91-.465 1.334c0 .47.145.782.432.926.286.145.73.137 1.332-.023v2.27c-.47.174-.79.143-.964-.097-.1-.132-.158-.382-.18-.753-.246.105-.49.21-.736.31 0 .478.08.823.236 1.04.29.398.837.447 1.645.13v.81l.397-.18v-.81c.502-.283.886-.567 1.15-.853.48-.52.722-1.14.722-1.877-.004-.513-.19-.826-.565-.926zm-1.705.178c-.312.08-.558.084-.74.01-.184-.073-.274-.25-.274-.522 0-.23.078-.48.23-.756.157-.276.42-.506.784-.687v1.955zm1.377 1.905c-.18.402-.508.722-.98.96v-2.188c.346-.063.592-.074.738-.034.256.068.383.275.383.623 0 .218-.047.43-.14.64z"/></svg>
        </div>

        <div class="row">
            <div class="col-md-12">
                @yield('content','Default content')
            </div>
        </div>

        <div class="footer">
            @include('partials.footer')
        </div>
    </div>


@if ( $_ENV['JS_DIST'] )
    <script src="{{ asset('js/dist/Expenses.app.min.js') }}"></script>
@else
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular-route/angular-route.js') }}"></script>
    <script src="{{ asset('bower_components/angular-google-chart/ng-google-chart.js') }}"></script>
    <script src="{{ asset('js/lib/ui-bootstrap-custom-0.12.0.js') }}"></script>
    <script src="{{ asset('js/lib/ui-bootstrap-custom-tpls-0.12.0.js') }}"></script>
    <script src="{{ asset('js/app/app.js') }}"></script>
    <script src="{{ asset('js/app/filters.js') }}"></script>
    <script src="{{ asset('js/app/directives.js') }}"></script>
    <script src="{{ asset('js/app/message.js') }}"></script>
    <script src="{{ asset('js/app/main-navigation.js') }}"></script>
    <script src="{{ asset('js/app/factories.js') }}"></script>
    <script src="{{ asset('js/app/controllers.js') }}"></script>
    <script src="{{ asset('js/app/edit.js') }}"></script>
    <script src="{{ asset('js/app/create.js') }}"></script>
    <script src="{{ asset('js/app/statistics.js') }}"></script>
    <script src="{{ asset('js/app/filter.js') }}"></script>
@endif
</body>
</html>

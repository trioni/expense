<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
@include('partials.htmlhead')
<body ng-app="expenses">
    <messageview></messageview>

    <div class="container">
        <div class="header">
            <main-navigation></main-navigation>
            <h3 class="text-muted">{{ Lang::get('app.title'); }}</h3>
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

    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular-route/angular-route.js') }}"></script>
    <script src="{{ asset('js/lib/ui-bootstrap-custom-0.12.0.js') }}"></script>
    <script src="{{ asset('js/lib/ui-bootstrap-custom-tpls-0.12.0.js') }}"></script>
    <script src="http://bouil.github.io/angular-google-chart/ng-google-chart.js"></script>
    <script src="{{ asset('js/app/app.js') }}"></script>
    <script src="{{ asset('js/app/filters.js') }}"></script>
    <script src="{{ asset('js/app/directives.js') }}"></script>
    <script src="{{ asset('js/app/message.js') }}"></script>
    <script src="{{ asset('js/app/main-navigation.js') }}"></script>
    <script src="{{ asset('js/app/factories.js') }}"></script>
    <script src="{{ asset('js/app/controllers.js') }}"></script>
    <script src="{{ asset('js/app/edit.js') }}"></script>
    <script src="{{ asset('js/app/delete.js') }}"></script>
    <script src="{{ asset('js/app/create.js') }}"></script>
    <script src="{{ asset('js/app/statistics.js') }}"></script>
    <script src="{{ asset('js/app/filter.js') }}"></script>
</body>
</html>

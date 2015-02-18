<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
@include('partials.htmlhead')
<body>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('js/dist/Expenses.min.js') }}"></script>
</body>
</html>

@extends('layouts.master')

@section('content')
{{ Form::open(array('route' => 'sessions.store', 'class'=>'login-form col-sm-6')) }}
<div class="form-group">
    {{ Form::label('username', 'Användare') }}
    {{ Form::text('username','', array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('password', 'Lösenord') }}
    {{ Form::password('password',array('class'=>'form-control')) }}
</div>
    {{ Form::submit('Logga in',array('class'=>'btn btn-primary')) }}
{{ Form::close() }}

<div class="col-sm-6">
    <h2>Kul att du kunde komma!</h2>
    <p>Lorem ipsum dolar sit amet</p>
</div>

@stop
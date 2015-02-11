@extends('layouts.master')

<!--@include('expenses.partials.formvars')-->
<?php
$currentDate = new DateTime('NOW');
?>

@section('headscripts')
    app.autocomplete = {
        titles: {{ $titles }}
    };
@stop

@section('content')
<h2>{{ Lang::get('app.pages.add.title')}}</h2>

{{ Form::open(array('action'=>'ExpenseController@store', 'class'=>'add-form','id'=>'add-form')) }}

<div class="form-group btn-group btn-group-justified mandatory" data-toggle="buttons" data-error="Val saknas">
    @include('expenses.partials.userfield')
</div>

<div class="form-group mandatory">
    {{ Form::label('title','Titel') }}
    {{ Form::text('title','',array('class'=>'form-control typeahead','placeholder'=>'Titel')) }}
</div>

<!--http://twitter.github.io/typeahead.js/examples/-->

<div class="form-group btn-group btn-group mandatory field-type" data-toggle="buttons">
    @include('expenses.partials.typefield')
</div>

<div class="form-group input-group mandatory">
    <span class="input-group-addon">$</span>
    {{ Form::input('number', 'expense',null,array('class'=>'form-control','required'=>'required')) }}
    <span class="input-group-addon">hkd</span>
</div>
<div class="form-group">
    {{ Form::label('date','Datum') }}
    {{ Form::input('date','date', $currentDate->format('Y-m-d'), array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::hidden('include', 0); }}
    {{ Form::checkbox('include', 1, true); }}
    {{ Form::label('include','Inkludera i summering') }}
</div>
{{ Form::submit('Spara',array('class'=>'btn btn-primary')) }}

{{ Form::close() }}
@stop
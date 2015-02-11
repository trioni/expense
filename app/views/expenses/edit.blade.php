@extends('layouts.master')

<?php
$currentDate = new DateTime('NOW');
?>

@section('headscripts')
    app.autocomplete = {
        titles: {{ $titles }}
    };
@stop

@section('content')
<h2>{{ Lang::get('app.actions.edit') }} {{ $expense->title }}</h2>

{{ Form::model($expense, array('method'=>'PATCH','route'=>array('expenses.update',$expense->id), 'class'=>'edit-form', 'id'=>'edit-form')) }}

<div class="form-group btn-group btn-group-justified mandatory" data-toggle="buttons" data-error="Val saknas">
    @include('expenses.partials.userfield')
</div>

<div class="form-group mandatory">
    {{ Form::label('title',Lang::get('app.forms.labels.title')) }}
    {{ Form::text('title',null,array('class'=>'form-control typeahead','placeholder'=>'Titel')) }}
</div>

<div class="form-group btn-group btn-group mandatory field-type" data-toggle="buttons">
    @include('expenses.partials.typefield')
</div>

<div class="form-group input-group mandatory">
    <span class="input-group-addon">$</span>
    {{ Form::input('number', 'expense',null,array('class'=>'form-control','required'=>'required')) }}
    <span class="input-group-addon">hkd</span>
</div>
<div class="form-group">
    {{ Form::label('date',Lang::get('app.forms.labels.date')) }}
    {{ Form::input('date','date', null, array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::hidden('include', 0); }}
    {{ Form::checkbox('include', 1); }}
    {{ Form::label('include',Lang::get('app.forms.labels.include')) }}
</div>
{{ Form::submit(Lang::get('app.actions.save'),array('class'=>'btn btn-primary')) }}

{{ Form::close() }}
@stop
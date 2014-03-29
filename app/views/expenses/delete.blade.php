@extends('layouts.master')

@section('content')
<h2>Ta bort {{ $expense->title }}</h2>
{{ Form::open(array('method'=>'DELETE','route'=>array('expenses.destroy',$expense->id),'class'=>'delete-form')) }}
<p>Är du säker att på att du vill ta bort {{ $expense->title }}?</p>
{{ Form::submit('Ja',array('class'=>'btn btn-default btn-confirm')) }}
<a href="/">Nej, avbryt</a>
{{ Form::close() }}
@stop
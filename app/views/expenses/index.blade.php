@extends('layouts.master')

@section('content')
@include('partials.summary')

@if ( Config::get('app.angular') )
<div ng-view></div>
@endif
<div class="row">
    <div class="col-xs-12">
        <h2>{{ Lang::get('app.list.title') }}</h2>
    </div>

    <div class="filter col-xs-12">
        {{ HTML::filter_active('expenses/filter/', Lang::get('app.filter.latest')) }}

        @foreach( Config::get('users') as $user )
        {{ HTML::filter_active('expenses/filter/?owner='.$user['value'], $user['display'],'owner',$user['value']) }}
        @endforeach
    </div>


@if ( Config::get('app.angular') )
    <div class="col-xs-12" ng-controller="ListCtrl as list">
        <p class="list-summary">[[ list.summary ]]</p>
        <div class="list-group">
            @include('expenses.angular.expense--single')
        </div>
    </div>
@else
    @if( count( $filtered ) == 0)
    <div class="col-xs-12">
        <p>Här var det tomt...</p>
    </div>
    @else
    <div class="col-xs-12">
        <div class="list-group">
            @foreach($filtered as $expense)
            <div class="list-group-item expense">
                @include('expenses.single.list')
            </div>
            @endforeach
        </div>
    </div>
    @endif
@endif
</div>

<div class="row">
    <div class="col-xs-12">
        {{ $filtered->appends( Request::except('page') )->links() }}
    </div>
</div>

@stop
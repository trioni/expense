@extends('layouts.angular')

@section('content')
@include('partials.summary')

<div ng-view></div>
<div class="row">
    <div class="col-xs-12">
        <h2>{{ Lang::get('app.list.title') }}</h2>
    </div>

    <div class="filter col-xs-12">
        {{-- Add latest and user filters here --}}
    </div>

    <div class="col-xs-12" ng-controller="ListCtrl as list">
        <div class="list-group">
            @include('expenses.angular.expense--single')
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <pagination ng-hide="numPages < 2" ng-controller="PagingCtrl" ng-model="currentPage" num-pages="numPages" total-items="totalItems" items-per-page="itemsPerPage" ng-change="changePage()" boundary-links="false"></pagination>
    </div>
</div>
@stop


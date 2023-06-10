@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')
    @include('component.home_categories.list')
    @include('component.home_categories.ordering')
    @include('component.home_categories.create')
    @include('component.home_categories.update')
    @include('component.home_categories.delete')
@endsection

@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')
    @include('component.HomeCategoryTrending.list')
    @include('component.HomeCategoryTrending.create')
{{--    @include('component.HomeCategoryTrending.update')--}}
    @include('component.HomeCategoryTrending.delete')
    @include('component.HomeCategoryTrending.ordering')
@endsection

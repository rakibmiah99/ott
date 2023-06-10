@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')
    @include('component.FeatureMovies.list')
    @include('component.FeatureMovies.create')
    {{--    @include('component.HomeCategoryTrending.update')--}}
    @include('component.FeatureMovies.delete')
    @include('component.FeatureMovies.ordering')
@endsection

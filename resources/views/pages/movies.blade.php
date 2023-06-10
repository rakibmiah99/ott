@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')

    @include('component.Movies.list')
    @include('component.Movies.create')
    @include('component.Movies.update')
    @include('component.Movies.delete')
    @include('component.Movies.image_1')
{{--    @include('component.Movies.video_preview')--}}
@endsection

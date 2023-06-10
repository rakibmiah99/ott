@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')

    @include('component.MoviesPart.list')
    @include('component.MoviesPart.create')
    @include('component.MoviesPart.update')
    @include('component.MoviesPart.delete')
    @include('component.MoviesPart.image_1')
    {{--    @include('component.Movies.video_preview')--}}
@endsection

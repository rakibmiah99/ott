@extends('layout.app')
@section('broadcumb')
{{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')
    @include('component.filmindustry.list')
    @include('component.filmindustry.create')
    @include('component.filmindustry.update')
    @include('component.filmindustry.delete')
@endsection

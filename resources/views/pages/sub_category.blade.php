@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')
    @include('component.SubCategory.list')
    @include('component.SubCategory.create')
    @include('component.SubCategory.update')
    @include('component.SubCategory.delete')
@endsection

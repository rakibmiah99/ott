@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')
    @include('component.Subscription.list')
    @include('component.Subscription.create')
    @include('component.Subscription.update')
    @include('component.Subscription.delete')
@endsection

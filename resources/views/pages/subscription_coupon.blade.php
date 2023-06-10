@extends('layout.app')
@section('broadcumb')
    {{--    @include('component.broadcumb_demo')--}}
@endsection
@section('main-content')
    @include('component.SubscriptionCoupon.list')
    @include('component.SubscriptionCoupon.create')
    @include('component.SubscriptionCoupon.update')
    @include('component.SubscriptionCoupon.delete')
@endsection

@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message')
{{__($exception->getMessage() ?: 'Unauthorized')}}
<a href="{{ route('home') }}"> - {{ __('Ir Home') }}</a>
@endsection

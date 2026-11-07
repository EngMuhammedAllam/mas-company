{{-- Unused module scaffold page. Uses @extends because the module does not
     register an anonymous-component namespace, which broke `artisan view:cache`. --}}
@extends('auth::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('auth.name') !!}</p>
@endsection

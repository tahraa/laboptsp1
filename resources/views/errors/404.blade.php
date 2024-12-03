{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

@extends('layout')
@section('content')
<div class="container mt-4">
    <div class="alert alert-danger" role="alert">
        <strong>Pas des résultats.</strong> 
        404 erreur
    </div>
</div>
@endsection

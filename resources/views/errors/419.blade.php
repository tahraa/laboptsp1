{{-- @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired')) --}}
@extends('layout')
@section('content')
<div class="container mt-4">
    <div class="alert alert-danger" role="alert">
        <strong>La page est expirée.</strong> 
        419 erreur
    </div>
</div>
@endsection
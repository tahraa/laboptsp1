@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <ul>
        <p>Logs/detail</p>
        @if (Session::has('success'))
            <div class="container alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        @if (Session::has('denied'))
            <div class="container alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('denied') }}</p>
            </div>
        @endif
        <li>utilisateur : {{ $log->user }}</li>
        <li>email : {{ $log->email }}</li>
        <li>date_création : {{ $log->created_at }}</li>
    </ul>
    <span class="text-primary">Action :</span>
    <p class="text-hint font-weight-bold">
        {{$log->action}}
    </p>
@endsection

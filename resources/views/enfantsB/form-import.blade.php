@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
@if ($user_logged_in->profile == 'profil3'||$user_logged_in->profile == 'profil2'||$user_logged_in->profile == 'profil1')
    <form action="{{ route('enfantsb-import') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card-header text-primary"><h4>Import & Export Reste du scellé</h4>
        </div>
        <div class="card-body">
        <div class="form-group">
        <label for="my-input">Ficher Excel</label>
        <input required="required" id="my-input" class="form-control-file" type="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">
            Importer
        </button>
    </form>
    </div>
        <div class="card-body">
    <div class="row justify-content">
    <div class="card">
    <div class="card-header"> Exporter le liste des Restes du scellé(s) </div>

<form role="form" action="{{ route('enfantsb-export') }}" method="post" enctype="multipart/form-data">
    @csrf

    <button type="submit" class="btn btn-primary">
    Download
    </button></form></div> </div> </div>
    @else
    @php
        header("Location: " . URL::to('/'), true, 302);
        exit();
    @endphp
@endif

@endsection

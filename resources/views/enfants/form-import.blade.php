@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
@if ($user_logged_in->profile == 'profil3')
    <form action="{{ route('enfants-import') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="form-group">
        <label for="my-input">Ficher Excel</label>
        <input required="required" id="my-input" class="form-control-file" type="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">
            Importer
        </button>
    </form>

    <div class="row justify-content">
    <div class="card">
    <div class="card-header"> Exporter le liste des Enfants</div>
   
<form role="form" action="{{ route('enfants-export') }}" method="post" enctype="multipart/form-data">
    @csrf
   
    <button type="submit" class="btn btn-primary">
    Download
    </button></form></div> </div> 


    @else
    @php
        header("Location: " . URL::to('/'), true, 302);
        exit();
    @endphp
@endif

@endsection

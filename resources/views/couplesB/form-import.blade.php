@extends('layout')
@section('content')

@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
@if ($user_logged_in->profile == 'profil3')
<form action="{{ route('couplesb-import') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="card-header text-primary"><h4>Import & Export/Conjoint(e) Contractuel(le)</h4>
        </div>
        <div class="card-body">
    <div class="form-group">
      <label for="my-input">Fiechier Excel</label>
      <input id="my-input" class="form-control-file" type="file" name="file">
    </div>
    <button type="submit" class="btn btn-primary">
        Importer
    </button>
</form>




</div>
        <div class="card-body">

<div class="row justify-content">
    <div class="card">
    <div class="card-header"> Liste des Conjoints Contractuels</div>
   
<form role="form" action="{{ route('conjointsb-export') }}" method="post" enctype="multipart/form-data">
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

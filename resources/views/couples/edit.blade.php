@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')


        <div class="card-header"><h2>Modifier/Conjoint</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('couples.update', ['couple'=>$couple->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <div class="table-responsive">
                    @if ($couple->image == null)
                        <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                    @else
                        <img src="{{ asset('/public/couple_images/'.$couple->nni.'.jpg') }}" width="100px" height="100px">
                    @endif
                    <div class="form-group">
                        <label for="nni">nni</label>
                        <input id="nni" maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni', $couple->nni ?? null) }}"/>
                    </div>
                    <div class="form-group">
                        <label for="nom">nom</label>
                        <input id="nom" required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom', $couple->nom ?? null) }}"/>
                    </div>
                    <div class="form-group">
                        <label for="pr">prénom</label>
                        <input id="pr" required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom', $couple->prenom ?? null) }}"/>
                    </div>

                    {{-- <div class="form-group">
                        <label for="nn">n°cnam</label>
                        <input id="nn" maxlength="8" required="required" type="text" name="num_cnam" placeholder="Entrer n°cnam" class="form-control" value="{{ old('nni',$couple->num_cnam ?? null) }}"/>
                      </div> --}}
                    <div class="form-group">
                        <label for="st">Statut</label>
                        <select id="st" required="required" name="statut" id="" class="form-control"><option {{ $couple->statut ? 'selected' : '' }} value="1"  >assuré</option><option value="0" {{ !$couple->statut ? 'selected' : '' }} >non assuré</option></select>
                    </div>
                  {{--   <div class="form-group">
                        <label for="sx">Sexe</label>
                        <select id="sx" required="required" name="sexe" id="" class="form-control"><option {{ $couple->sexe == 'masculin' ? 'selected' : '' }}  value="masculin">masculin</option><option {{ $couple->sexe == 'feminin'  ? 'selected' : '' }} value="feminin">féminin</option></select>
                    </div> --}}
                    <div class="form-group">
                        <label for="ph">Photo</label>
                        <input id="ph" type="file" name="c_image" class="form-control" value="{{ old('c_image') }}"/>
                    </div>

            </div>
                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
        </div>
        @else
            <div class="alert alert-warning" role="alert">
                Vous n'avez pas l'accès à cette page.
            </div>
            @php
                header("Location: " . URL::to('/'), true, 302);
                exit();
            @endphp
        @endif
    </div>
</div>
@endsection

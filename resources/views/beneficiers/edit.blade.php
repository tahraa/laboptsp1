@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')

        <div class="card-header text-primary"><h2>Modifier/Bénéficier</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('beneficier.update', ['beneficier'=>$beneficier->id]) }}" method="POST" enctype="multipart/form-data">
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
                <p>Bénéficier:  nombre couple : {{ $beneficier->couples_count }}   nombre enfants : {{ $beneficier->enfants_count }}</p>
                <div class="table-responsive">
                        <img src="{{ asset('/emp_images/'.$beneficier->matricule.'.jpg') }}" width="100px" height="100px">
                        <p class="font-weight-bold">matricule : {{ $beneficier->matricule }}</p>
                        <input type="hidden" name="matricule" value="{{ $beneficier->matricule }}" type="text">
                        <div class="form-group">
                          <label for="nni">nni</label>
                          <input id="nni" maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni', $beneficier->nni ?? null) }}"/>
                        </div>
                        <div class="form-group">
                          <label for="nom">nom</label>
                          <input id="nom" required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom', $beneficier->nom ?? null) }}"/>
                        </div>
                        <div class="form-group">
                          <label for="prenom">prénom</label>
                          <input id="prenom" required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom', $beneficier->prenom ?? null) }}"/>
                        </div>
                        <div class="form-group">
                          <label for="dn">date naissance</label>
                          <input id="dn" required="required"  type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', $beneficier->date_naissance ?? null) }}" />
                        </div>
                        <div class="form-group">
                          <label for="st">statut</label>
                          <select id="st"  required="required" name="statut" id="" class="form-control"><option {{ $beneficier->statut ? 'selected' : '' }} value="1"  >assuré</option><option value="0" {{ !$beneficier->statut ? 'selected' : '' }} >non assuré</option></select>
                        </div>
                        <div class="form-group">
                          <label for="st">sexe</label>
                          <select id="st" required="required" name="sexe" id="" class="form-control"><option {{ $beneficier->sexe == 'masculin' ? 'selected' : '' }}  value="masculin">masculin</option><option {{ $beneficier->sexe == 'feminin'  ? 'selected' : '' }} value="feminin">féminin</option></select>
                        </div>
                        <div class="form-group">
                        <label for="etablissement">établissement </label>
                        <select id="etablissement" required="required" name="etablissement" id="" class="form-control"><option {{ $beneficier->etablissement == 'NDB' ? 'selected' : '' }}  value="NDB">NDB</option><option {{ $beneficier->etablissement == 'ZTE'  ? 'selected' : '' }} value="ZTE">ZTE</option></select>
                      </div>
                        <div class="form-group">
                          <label for="photo">photo</label>
                          <input id="photo"  type="file" name="benef_image" class="form-control" value=""/>
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

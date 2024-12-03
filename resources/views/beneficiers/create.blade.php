@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')

        <div class="card-header text-primary"><h2>Ajouter/Béneficier</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <p>matricule : {{ $max }}</p>
            <form action="{{ route('beneficier.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
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
                {{-- <p>Employé:  nombre couple : {{ $employe->couples_count }}   nombre enfants : {{ $employe->enfants_count }}</p> --}}

             <div class="form-group">
               <label for="nni">nni</label>
               <input id="nni" maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni') }}"/>
             </div>
             <input type="hidden" name="matricule" value="{{$max}}" type="text">
             <div class="form-group">
               <label for="nom">nom</label>
               <input id="nom" required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom') }}"/>
             </div>
             <div class="form-group">
               <label for="prenom">prénom</label>
               <input id="prenom" required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom') }}"/>
             </div>
             <div class="form-group">
               <label for="st">statut</label>
               <select id="st" required="required" name="statut" id="" class="form-control"><option {{ old('statut') == true ? 'selected' : '' }} value="1">assuré</option><option {{ old('statut') == false ? 'selected' : '' }}  value="0">non assuré</option></select>
             </div>
             <div class="form-group">
               <label for="sexe">sexe</label>
               <select id="sexe" required="required" name="sexe" id="" class="form-control"><option {{ old('sexe') == 'masculin' ? 'selected' : '' }} value="masculin">masculin</option><option {{ old('sexe') == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select>
             </div>
             {{-- <div class="form-group">
                <label for="nc">n°cnam</label>
                <input id="nc" required="required" type="text" name="num_cnam" placeholder="Enter num_cnam" class="form-control" value="{{ old('num_cnam') }}"/>
            </div> --}}
            <div class="form-group">
                <label for="dn">date naissance</label>
                <input id="dn" required="required"  type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}"/>
            </div>
            <div class="form-group">
                <label for="nc">n°cnam</label>
                <input id="nc" maxlength="8" required="required" type="text" name="num_cnam" placeholder="Enter n°cnam" class="form-control" value="{{ old('num_cnam') }}"/>
              </div>
             <div class="form-group">
               <label for="situation_civile">situation_civile</label>
               <select id="situation_civile" required="required" name="situation_civile" class="form-control"><option {{ old('situation_civile') == 'Célib.' ? 'selected' : '' }} value="Célib.">Célib</option><option {{ old('situation_civile') == 'Marié' ? 'selected' : '' }} value="Marié">Marié</option></select>
             </div>
             <div class="form-group">
                <label for="service">fonction : </label>
                <label class="radio-inline"><input value="EMAM" type="radio" name="service" required>EMAM</label>
                <label class="radio-inline"><input value="DREN" type="radio" name="service" required>DREN</label>
                <label class="radio-inline"><input value="GENDARMERIE" type="radio" name="service" required>GENDARMERIE</label>
             </div>
             <div class="form-group">
                <label for="etablissement">établissement : </label>
                <label class="radio-inline"><input value="NDB" type="radio" name="etablissement" required>NDB</label>
                <label class="radio-inline"><input value="ZTE" type="radio" name="etablissement" required>ZTE</label>
             </div>
             <div class="form-group">
               <label for="photo">photo</label>
               <input id="photo" required="required" type="file" name="emp_image" class="form-control" value="{{ old('emp_image') }}"/>
             </div>
                <button type="submit" class="btn btn-success">Enregistrer</button>
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

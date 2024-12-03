@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')

        <div class="card-header text-primary"><h2>Ajouter/Employé </h2>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('empone.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                {{-- <div>
                    <a type="button" href="{{ route('beneficier.create') }}"  class="btn btn-primary pull-right "><div class="glyphicon glyphicon-plus"></div> Ajouter/Béneficier hors de la SNIM</a>
                </div> --}}
                {{-- <p>Employé:  nombre couple : {{ $employe->couples_count }}   nombre enfants : {{ $employe->enfants_count }}</p> --}}
             <div class="form-group">
               <label for="m">matricule</label>
               <input id="m" maxlength="5" required="required" type="text" name="matricule" placeholder="Enter matricule" class="form-control" value="{{ old('matricule') }}"/>
             </div>
             <div class="form-group">
               <label for="nni">nni</label>
               <input id="nni" maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni') }}"/>
             </div>
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
             <div class="form-group">
               <label for="service">service</label>
               <input id="service" maxlength="6" required="required"  type="text" name="service" class="form-control" value="{{ old('service') }}" />
             </div>
             <div class="form-group">
                <label for="nc">n°cnam</label>
                <input id="nc" maxlength="8" required="required" type="text" name="num_cnam" placeholder="Enter num_cnam" class="form-control" value="{{ old('num_cnam') }}"/>
            </div>
            <div class="form-group">
                <label for="dn">date naissance</label>
                <input id="dn" required="required"  type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}"/>
            </div>
            <div class="form-group">
              <label for="situation_civile">situation_civile</label>
              <select id="situation_civile" required="required" name="situation_civile" id="" class="form-control"><option {{ old('situation_civile') == 'Célib.' ? 'selected' : '' }} value="Célib.">Célib</option><option {{ old('situation_civile') == 'Marié' ? 'selected' : '' }} value="Marié">Marié</option></select>
            </div>
            <div class="form-group">
                <label for="ets">établissement</label>
                <select name="etablissement" id="ets" class="form-control" required>
                  <option value="NDB">NDB</option>
                  <option value="ZTE">ZTE</option>
                </select>
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

@extends('layout')
@section('content')
@php
$user_id = auth()->user()->id;
$user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <div class="card">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
        <div class="card-header text-primary"><h2>Ajouter/Enfant </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('enfants.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="table-responsive">
                        <div class="form-group">
                          <label for="nni">nni</label>
                          <input id="nni" maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni') }}"/>
                        </div>
                        <div class="form-group">
                          <label for="nom">nom</label>
                          <input id="nom"  required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom') }}"/>
                        </div>
                        <div class="form-group">
                          <label for="prenom">prénom</label>
                          <input id="prenom" required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="numc">n°cnam</label>
                            <input id="numc" maxlength="8" required="required" type="text" name="num_cnam" placeholder="Enter num cnam" class="form-control" value="{{ old('num_cnam') }}"/>
                          </div>
                        <div class="form-group">
                          <label for="st">statut</label>
                          <select id="st"  required="required" name="statut" id="" class="form-control"><option {{ old('statut') == true ? 'selected' : '' }} value="1"  >assuré</option><option {{ old('statut') == false ? 'selected' : '' }} value="0" >non assuré</option></select>
                        </div>
                        <div class="form-group">
                          <label for="sx">sexe</label>
                          <select id="sx"  required="required" name="sexe" id="" class="form-control"><option {{ old('sexe') == 'masculin' ? 'selected' : '' }}  value="masculin">masculin</option><option {{ old('sexe') == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select>
                        </div>
                        <div class="form-group">
                          <label for="dn">date naissance</label>
                          <input id="dn" required="required"  type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="sc">scolarisation</label>
                            <select id="sc"  required="required" name="scolarite" class="form-control">
                                <option value="1">Scolarisé</option>
                              <option value="0">Non Scolarisé</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <label for="emp">Employé</label>
                            <select id="emp"  required="required" name="employe" class="form-control selectemp" id="">
                                <option disabled selected value="vide">choisir l'employé</option>
                                @forelse ($employes as $employe)
                                <option {{ old('employe') == $employe->id ? 'selected' : '' }}  value="{{$employe->id}}">{{$employe->matricule}}</option>
                                @empty
                                @endforelse
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="photo">photo</label>
                            <input id="photo"  required="required"  type="file" name="e_image" class="form-control" value="{{ old('e_image') }}"/>
                          </div>

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

@endsection

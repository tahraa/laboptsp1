@extends('layout')
@section('content')
@php
$user_id = auth()->user()->id;
$user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <div class="card">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil1')
        <div class="card-header text-primary"><h2>Ajouter/Intervenant </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('intervenants.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="m">matricule</label>
                        <input id="m" maxlength="12" required="required" type="text" name="matricule" placeholder="Entrer matricule" class="form-control" value="{{ old('matricule') }}"/>
                      </div>

                        <div class="form-group">
                          <label for="nom">nom</label>
                          <input id="nom"  required="required" type="text" name="nom" placeholder="Entrer nom" class="form-control" value="{{ old('nom') }}"/>
                        </div>
                        <div class="form-group">
                          <label for="prenom">prénom</label>
                          <input id="prenom" required="required" type="text" name="prenom" placeholder="Entrer prénom" class="form-control" value="{{ old('prenom') }}"/>
                        </div>
                        <div class="form-group">
                            <label for=" grade">grade</label>
                            <input id=" grade"  required="required" type="text" name="grade" placeholder="Entrer grade" class="form-control" value="{{ old('grade') }}"/>
                          </div>
                     
                        <div class="form-group">
                            <label for="dn">date d'intervention</label>
                            <input id="dn" required="required"  type="date" name="date_intervention" class="form-control" value="{{ old('date_intervention') }}"/>
                          </div>

                        <div class="form-group">
                            <label for="emp">Affaire</label>
                            <select id="emp"  required="required" name="employe" class="form-control selectemp" id="">
                                <option disabled selected value="vide">choisir le numero d'affaire</option>
                                @forelse ($affaires as $employe)
                                <option {{ old('employe') == $employe->id ? 'selected' : '' }}  value="{{$employe->id}}">{{$employe->num_affaire}}</option>
                                @empty
                                @endforelse
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="photo">photo</label>
                            <input id="photo"  type="file" name="e_image" class="form-control" value="{{ old('e_image') }}"/>
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

@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp

<div class="card">
    @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3' || $user_logged_in->profile == 'profil1')
        <div class="card-header text-primary">
            <h2>Ajouter Profil Génétique</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('genetic-profiles.store') }}" method="POST" id="geneticProfileForm">
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

                        <div class="form-group">
                            <label for="emp">N°Affaire</label>
                            <select id="emp" required="required" name="affaire_id" class="form-control selectemp">
                                <option disabled selected value="vide">Choisir le numéro d'affaire</option>
                                @forelse ($affaires as $affaire_id)
                                    <option {{ old('affaire_id') == $affaire_id->id ? 'selected' : '' }} value="{{$affaire_id->id}}">{{$affaire_id->num_affaire}}</option>
                                @empty
                                    <option disabled>Aucune affaire disponible</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_known">Connu ou Inconnu:</label>
                            <select class="form-control" id="is_known" name="is_known">
                                <option value="1" {{ old('is_known') == '1' ? 'selected' : '' }}>Connu</option>
                                <option value="0" {{ old('is_known') == '0' ? 'selected' : '' }}>Inconnu</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="code">Code:</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                        </div>

                        <!-- Additional fields for 'Connu' profiles -->
                        <div id="additionalFields" style="display: {{ old('is_known') == '1' ? 'block' : 'none' }};">
                            <div class="form-group">
                                <label for="prenom">Prénom:</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}">
                            </div>

                            <div class="form-group">
                                <label for="nom">Nom de famille:</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
                            </div>

                            <div class="form-group">
                                <label for="date_naissance">Date de naissance:</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                            </div>

                            <div class="form-group">
                                <label for="lieu_naissance">Lieu de naissance:</label>
                                <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}">
                            </div>

                            <div class="form-group">
                                <label for="nni">Numéro d'Identification National (NNI):</label>
                                <input type="text" class="form-control @error('nni') is-invalid @enderror" id="nni" name="nni" value="{{ old('nni') }}" placeholder="Entrez le NNI 10 chiffres" pattern="[0-9]{10}" title="Le NNI doit être numérique et comporter exactement 10 chiffres" maxlength="10">
                                @error('nni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="motif_nom">Motif:</label>
                                <input type="text" class="form-control" id="motif_nom" name="motif_nom" value="{{ old('motif_nom') }}">
                            </div>

                            <div class="form-group">
                                <label for="nomcriminel">Nom Criminel:</label>
                                <input type="text" class="form-control" id="nomcriminel" name="nomcriminel" value="{{ old('nomcriminel') }}">
                            </div>
                        </div>

                        <!-- Buttons to choose marker type -->
                        <div class="form-group">
                            <button type="submit" name="marker_type" value="autosome" class="btn btn-success">Aj.allèles autosomiques</button>
                            <button type="submit" name="marker_type" value="y" class="btn btn-secondary">Aj.allèles gonosomiques Y</button>
                        </div>
                    </form>
                </div>
            </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var isKnownSelect = document.getElementById('is_known');
        var additionalFields = document.getElementById('additionalFields');

        isKnownSelect.addEventListener('change', function () {
            if (this.value == '1') {
                additionalFields.style.display = 'block';
            } else {
                additionalFields.style.display = 'none';
            }
        });
    });
</script>

@endsection

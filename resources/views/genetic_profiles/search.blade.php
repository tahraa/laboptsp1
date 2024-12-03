@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Affichage des messages de succès ou d'erreur -->
        @if ($errors->any() || Session::has('success'))
            <div class="alert alert-{{ $errors->any() ? 'danger' : 'success' }} text-center">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (Session::has('success'))
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                @endif
            </div>
        @endif
        <form action="{{ route('genetic_profiles.search') }}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <input type="text" name="code" class="form-control" placeholder="Code" value="{{ request('code') }}">
                </div>
                <div class="form-group col-md-3">
                    <input type="text" name="nom" class="form-control" placeholder="Nom" value="{{ request('nom') }}">
                </div>
                <div class="form-group col-md-3">
                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="{{ request('prenom') }}">
                </div>
                <div class="form-group col-md-3">
                    <input type="text" name="nni" class="form-control" placeholder="NNI" value="{{ request('nni') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <!-- Affichage des résultats de recherche s'il y en a -->
        @if(request()->has('code') || request()->has('nom') || request()->has('prenom') || request()->has('nni'))
            @if(isset($profiles) && $profiles->count())
                <div>
                    <h5 class="text-primary">Résultats de la Recherche</h5>
                    <table class="table table-bordered" style="font-size: 0.775rem; width: 100%; table-layout: auto;">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>NNI</th>
                                <th>Nom Criminel</th>
                                <th>Date de Naissance</th>
                                <th>Lieu de Naissance</th>
                                <th>Motif</th>
                                <th>ADN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($profiles as $profile)
                                <tr>
                                    <td>{{ $profile->code }}</td>
                                    <td>{{ $profile->nom }}</td>
                                    <td>{{ $profile->prenom }}</td>
                                    <td>{{ $profile->nni }}</td>
                                    <td>{{ $profile->nomcriminel }}</td>
                                    <td>{{ $profile->date_naissance }}</td>
                                    <td>{{ $profile->lieu_naissance }}</td>
                                    <td>{{ $profile->motif_nom }}</td>
                                 <td>
                <a href="{{ route('genetic-markers.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir</a>
            </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">Aucun profil trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $profiles->links() }}
                </div>
            @else
                <p>Aucun profil trouvé.</p>
            @endif
        @endif
    </div>
</div>
@endsection

@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
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

        <div class="card-header text-primary">
            <h4>Détails du Profil Génétique</h4>
        </div>

            <!-- Affichage spécifique en fonction de "is_known" -->
            @if($profile->is_known)
                <div class="mt-4">
                           <img src="{{ $imageExists ? asset('images/' . $profile->nni . '.jpg') : asset('images/default_image.jpg') }}" width="100px" height="100px">

                    <p><strong>Code :</strong> {{ $profile->code }}</p>
                    <p><strong>Nom et Prénom :</strong> {{ $profile->nom }} {{ $profile->prenom }}</p>
                    <p><strong>NNI :</strong> {{ $profile->nni }}</p>
                   
                    <p><strong>Date de Naissance :</strong> {{ $profile->date_naissance ?? 'Non disponible' }}</p>
                    <p><strong>Lieu de Naissance :</strong> {{ $profile->lieu_naissance ?? 'Non disponible' }}</p>
					 <p><strong>Nom Criminel :</strong> {{ $profile->nomcriminel ?? 'Non disponible' }}</p> <!-- Ajout de '??' pour gérer les valeurs nulles -->
                    <p><strong>Motif :</strong> {{ $profile->motif_nom }}</p>
                   <p><strong>Numéro d'Affaire :</strong> 
          @if($profile->affaires->isNotEmpty())
    @foreach($profile->affaires as $affaire)
        <p><strong>Numéro d'Affaire :</strong>
            <a href="{{ route('employes.show', ['employe' => $affaire->id]) }}" class="btn btn-link">
                {{ $affaire->num_affaire }}
            </a>
        </p>
    @endforeach
@else
    <span>Non disponible</span>
@endif
        </p>
                         
                    <!-- ADN (Autosome et Gonosome) -->
                    <p><strong>ADN Autosomique :</strong>
                        @if($profile->has_autosome)
                            <a href="{{ route('genetic-markers.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir ADN Autosomique</a>
                        @else
                            <span>Pas d'ADN Autosomique</span>
                        @endif
                    </p>
                    <p><strong>ADN Gonosomique :</strong>
                        @if($profile->has_gonosome)
                            <a href="{{ route('genetic-markers.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir ADN Gonosomique</a>
                        @else
                            <span>Pas d'ADN Gonosomique</span>
                        @endif
                    </p>
                </div>
            @else
                <div class="mt-4">
                    <h5 class="text-warning">Profil Inconnu</h5>
					      <p><strong>Code :</strong> {{ $profile->code }}</p>
                       
                    <p><strong>Motif :</strong> {{ $profile->motif_nom }}</p>

                    <!-- Pas d'ADN ou des informations limitées -->
                    <p><strong>Numéro d'Affaire :</strong> 
                        @if($profile->num_affaire)
                            <a href="{{ route('employes.show', ['employe' => $profile->affaire_id]) }}" class="btn btn-link">{{ $profile->num_affaire }}</a>
                        @else
                            <span>Non disponible</span>
                        @endif
                    </p>
                    <p><strong>ADN Autosome: </strong>   @if($profile->id)
                                        <a href="{{ route('genetic-markers.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir</a>
                                    @else
                                        <span>Pas de Profil</span>
                                    @endif
                      
                    </p>
                </div>
            @endif

            <!-- Boutons d'actions -->
            <div class="mt-4">
                <a href="{{ route('genetic-profiles.index') }}" class="btn btn-secondary btn-sm">Retour à la liste des profils</a>
               
            </div>
        </div>
    </div>
</div>
@endsection

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

        <div class="card-header text-primary d-flex justify-content-between align-items-center">
            <div>
                <h4>Liste des Profils Génétiques</h4>
                <p class="card-text text-success font-weight-bold">Total des profils : {{ $count_profiles }}</p>
            </div>
            <div>
                <button id="showKnown" class="btn btn-sm btn-primary mx-2">Profils Connus</button>
                <button id="showUnknown" class="btn btn-sm btn-secondary mx-2">Profils Inconnus</button>
            </div>
        </div>

        <div class="mt-4">
            <div id="knownProfilesTable" style="display:none;">
                <h5 class="text-primary">Profils Connus</h5>
              <table class="table table-bordered" style="font-size: 0.775rem; width: 100%; table-layout: auto;">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
							<th>NNI</th>
                          
                            <th>Date et Lieu de Naissance</th>
                         <th>Nom Criminel</th>
                            <th>Motif</th>
							  <th>N-Affaire</th>
                            <th>ADN  Autosome</th>
							 <th>ADN  Gonosome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($knownProfiles as $profile)
                            <tr>
                                <td>{{ $profile->code }}</td>
                       <td>{{ $profile->nom . ' ' . $profile->prenom }}</td>
								<td>{{ $profile->nni }}</td>
                            
                                <td>{{ $profile->date_naissance . ' ' . $profile->lieu_naissance  }}</td>
								    <td>{{ $profile->nomcriminel }}</td>
                                <td>{{ $profile->motif_nom }}</td>
								      <td>
                        @if($profile->num_affaire)
                          <a href="{{ route('employes.show', ['employe' => $profile->affaire_id]) }}" class="btn btn-link">
                          {{ $profile->num_affaire }}
                          </a>

                        @else
                            <span>Non disponible</span>
                        @endif
                    </td>
                           
            <td>
                <a href="{{ route('genetic-markers.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir</a>
            </td>
			  <td>
                <a href="{{ route('genetic-markers-y.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir</a>
            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $knownProfiles->links() }}
            </div>

            <div id="unknownProfilesTable" style="display:none;">
                <h5 class="text-primary">Profils Inconnus</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Motif</th>
                            <th>Numéro de l'Affaire</th>
                           <th>ADN  Autosome</th>
							 <th>ADN  Gonosome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unknownProfiles as $profile)
                            <tr>
                                <td>{{ $profile->code }}</td>
                                <td>{{ $profile->motif_nom }}</td>
                               		      <td>
                        @if($profile->num_affaire)
                          <a href="{{ route('employes.show', ['employe' => $profile->affaire_id]) }}" class="btn btn-link">
                          {{ $profile->num_affaire }}
                          </a>

                        @else
                            <span>Non disponible</span>
                        @endif
                    </td>
                         <td>
                                    {{-- Assurez-vous que $profile->id est défini --}}
                                    @if($profile->id)
                                        <a href="{{ route('genetic-markers.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir</a>
                                    @else
                                        <span>Pas de Profil</span>
                                    @endif
                                </td>
								  <td>
                                    {{-- Assurez-vous que $profile->id est défini --}}
                                    @if($profile->id)
                                        <a href="{{ route('genetic-markers.show', ['id' => $profile->id]) }}" class="btn btn-info btn-sm">Voir</a>
                                    @else
                                        <span>Pas de Profil</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $unknownProfiles->links() }}
            </div>
        </div>
    </div>
</div>

<!-- JavaScript pour basculer entre les listes -->
<script>
    document.getElementById('showKnown').addEventListener('click', function() {
        document.getElementById('knownProfilesTable').style.display = 'block';
        document.getElementById('unknownProfilesTable').style.display = 'none';
    });

    document.getElementById('showUnknown').addEventListener('click', function() {
        document.getElementById('unknownProfilesTable').style.display = 'block';
        document.getElementById('knownProfilesTable').style.display = 'none';
    });

    // Afficher par défaut les profils connus
    document.getElementById('showKnown').click();
</script>
@endsection

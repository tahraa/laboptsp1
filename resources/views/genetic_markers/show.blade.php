@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
	       <div class="card-header text-primary d-flex justify-content-between align-items-center">
            <div>
        <h4>ADN autosomiques pour le Profil:{{ $profile->code}}</h4>     </div> </div>
        @if (isset($message))
            <div class="alert alert-warning">
                {{ $message }}
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Marqueur</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    @if (is_object($geneticMarker))
                        <tr>
                            <td>Amel</td>
                            <td>{{ $geneticMarker->Amel }}</td>
                        </tr>

                        @php
                            // Créer un tableau pour stocker les valeurs par marqueur et éviter les doublons
                            $markersGrouped = [];
                        @endphp

                        @foreach ($geneticMarker->getAttributes() as $key => $value)
                            @if (str_contains($key, '_a') || str_contains($key, '_b') || (str_contains($key, '_c') && !is_null($value)))
                                @php
                                    // Extraire le nom du marqueur (avant le suffixe) et la valeur
                                    list($markerName, $suffix) = explode('_', $key, 2);

                                    // Ajouter uniquement les marqueurs qui n'ont pas encore été traités
                                    if (!isset($markersGrouped[$markerName])) {
                                        $markersGrouped[$markerName] = [];
                                    }

                                    // Ajouter la valeur au tableau des marqueurs, si ce n'est pas null
                                    if (!is_null($value)) {
                                        $markersGrouped[$markerName][] = $value;
                                    }
                                @endphp
                            @endif
                        @endforeach

                        <!-- Afficher les marqueurs regroupés avec leurs valeurs -->
                        @foreach ($markersGrouped as $markerName => $values)
                            <tr>
                                <td>{{ $markerName }}</td>
                                <td>{{ implode('/', $values) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2">Aucun marqueur génétique trouvé.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endif

        <a href="{{ route('genetic-profiles.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@endsection

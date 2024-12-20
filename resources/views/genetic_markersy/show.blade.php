@extends('layout')

@section('content')
<div class="card">
    <div class="card-header text-primary">
        <h2>Allèles Y pour le Profil codé: {{ $profile->code ?? 'Non défini' }}</h2>
    </div>

    <div class="card-body">
        @if (isset($message))
            <div class="alert alert-warning">{{ $message }}</div>
        @endif

        @if (isset($geneticMarkers) && count($geneticMarkers) > 0)  <!-- Vérifier si des marqueurs existent -->
         
            <table class="table">
                <thead>
                    <tr>
                        <th>Marqueur</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($geneticMarkers as $marker => $value) <!-- Boucle sur chaque marqueur -->
                        <tr>
                            <td>{{ $marker }}</td>  <!-- Nom du marqueur -->
                            <td>{{ $value ?? 'Non défini' }}</td>  <!-- Valeur du marqueur -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
    </div>
</div>
@endsection

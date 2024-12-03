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

     @if (isset($geneticMarkery))  <!-- Vérifier si geneticMarkery existe -->

            <h3>Marqueurs Y</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Marqueur</th>
                        <th>Allèle A</th>
                        <th>Allèle B</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($geneticMarkery->getAttributes() as $key => $value)
                        @if (strpos($key, '_a') !== false)  <!-- Afficher uniquement les marqueurs A -->
                            <tr>
                                <td>{{ str_replace('_a', '', $key) }}</td>
                                <td>{{ $value }}</td>
                                <td>{{ $geneticMarkery->{str_replace('_a', '_b', $key)} }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection

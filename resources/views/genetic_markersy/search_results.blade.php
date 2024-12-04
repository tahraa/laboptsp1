@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Affichage du message de correspondance -->
        <h3>Résultats de la recherche</h3>

        @if(isset($message))
            <div class="alert alert-info">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
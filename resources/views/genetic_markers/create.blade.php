@extends('layout')

@section('content')
@php
$user_id = auth()->user()->id;
$user_logged_in = \App\User::where('id', $user_id)->first();
@endphp

<div class="card">
    @if ($user_logged_in && in_array($user_logged_in->profile, ['profil1', 'profil2', 'profil3']))
        <div class="card-header text-primary">
            <h2>Ajouter les allèles autosomiques pour le Profil codé: {{ $profileData['code'] ?? 'Non défini' }}</h2>
        </div>

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

        <div class="card-body">
            <form id="geneticMarkersForm" action="{{ route('genetic-markers.store') }}" method="POST">
                @csrf
				    <div class="form-group">
            <label for="Amel">Amel:</label>
            <select class="form-control" id="Amel" name="Amel">
                <option value="" {{ old('Amel') === null ? 'selected' : '' }}>Select Amel</option>
                <option value="XX" {{ old('Amel') === 'XX' ? 'selected' : '' }}>XX</option>
                <option value="XY" {{ old('Amel') === 'XY' ? 'selected' : '' }}>XY</option>
            </select>
        </div>
                @foreach (['D3S1358', 'D1S1656', 'D6S1043', 'D13S317', 'Penta_E', 'D16S539', 'D18S51', 'D2S1338', 'DSF1PO', 'Penta_D', 'THO1', 'VWA', 'D21S11', 'D7S820', 'D55818', 'TPOX', 'D8S1179', 'D12S391', 'D19S433', 'FGA'] as $marker)
                    <div class="form-group">
                        <label for="{{ $marker }}_a">{{ $marker }}:</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="{{ $marker }}_a" name="{{ $marker }}_a" placeholder="a" value="{{ old($marker.'_a') }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="{{ $marker }}_b" name="{{ $marker }}_b" placeholder="b" value="{{ old($marker.'_b') }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="{{ $marker }}_c" name="{{ $marker }}_c" placeholder="c" value="{{ old($marker.'_c') }}">
                            </div>
                        </div>
                    </div>
                @endforeach
  
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </form>
        </div>
    @endif
</div>

@section('scripts')
<script>
document.getElementById('geneticMarkersForm').addEventListener('submit', function(event) {
    var inputs = this.querySelectorAll('input[type="text"]');
    var hasValue = false;
    var valid = true;
    var numberPattern = /^[0-9]+(\.[0-9]{1})?$/; // Positif entier ou réel avec une décimale

    inputs.forEach(function(input) {
        var value = input.value.trim();
        if (value !== '') {
            hasValue = true;
            if (!numberPattern.test(value)) {
                valid = false;
                input.style.borderColor = 'red'; // Indiquer visuellement l'erreur
            } else {
                input.style.borderColor = ''; // Réinitialiser le style en cas de succès
            }
        }
    });

    if (!hasValue) {
        event.preventDefault();
        alert('Au moins un marqueur doit être rempli.');
    } else if (!valid) {
        event.preventDefault();
        alert('Les valeurs doivent être des entiers positifs ou des réels avec au maximum un chiffre après la virgule.');
    }
});
</script>
@endsection
@endsection

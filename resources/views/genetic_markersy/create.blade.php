@extends('layout')

@section('content')
<div class="card">
    <div class="card-header text-primary">
        <h2>Ajouter les valeurs des Marqueurs Génétiques pour le Profil codé: {{ $profileData['code'] ?? 'Non défini' }}</h2>
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
        <form id="geneticMarkersForm" action="{{ route('genetic-markers-y.store') }}" method="POST">
            @csrf

            <!-- Boucle dynamique sur les marqueurs -->
            @foreach ([
                'DYS576', 'DYS389I', 'DYS448', 'DYS389II', 'DYS19', 'DYS391', 'DYS481',
                'DYS549', 'DY533', 'DY438', 'DY437', 'DYS570', 'DYS635', 'DYS390', 'DYS439',
                'DYS392', 'DYS643', 'DYS393', 'DYS458', 'DYS385', 'DYS456', 'YGATAH4'
            ] as $marker)
                <div class="form-group">
                    <label for="{{ $marker }}_a">{{ $marker }}:</label>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="{{ $marker }}_a" name="{{ $marker }}_a"
                                   placeholder="a" value="{{ old($marker.'_a') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="{{ $marker }}_b" name="{{ $marker }}_b"
                                   placeholder="b" value="{{ old($marker.'_b') }}">
                        </div>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </div>
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

@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Affichage des messages d'erreur ou de succès -->
        @if ($errors->any() || session('success'))
            <div class="alert alert-{{ $errors->any() ? 'danger' : 'success' }} alert-dismissible fade show" role="alert">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                @endif
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h3 class="mb-4">Recherche d'un Profil Gonosomique Y</h3>

 <form action="{{ route('genetic-markers-y.search') }}" method="GET">
    <div class="form-row">
        @foreach ([
            'DYS576', 'DYS389I', 'DYS448', 'DYS389II', 'DYS19', 'DYS391', 'DYS481',
            'DYS549', 'DY533', 'DY438', 'DY437', 'DYS570', 'DYS635', 'DYS390', 'DYS439',
            'DYS392', 'DYS643', 'DYS393', 'DYS458', 'DYS385', 'DYS456', 'YGATAH4'
        ] as $marker)
            <div class="form-group col-md-2 mb-3">
                <label for="{{ $marker }}_a">{{ $marker }}</label>
                <div class="input-group">
                    <input type="text" id="{{ $marker }}_a" name="{{ $marker }}_a" value="{{ request($marker . '_a') }}" class="form-control form-control-sm" placeholder="Valeur A">
                    <input type="text" id="{{ $marker }}_b" name="{{ $marker }}_b" value="{{ request($marker . '_b') }}" class="form-control form-control-sm" placeholder="Valeur B">
                </div>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>


        <!-- Affichage du message de résultats -->
        @if(isset($message))
            <div class="alert alert-info mt-4">
                <p>{{ $message }}</p>
                @if(isset($matchPercentage))
                    <p>Correspondances : {{ $matches }} sur {{ $totalPairs }}</p>
                    <p>Pourcentage de correspondance : {{ number_format($matchPercentage, 2) }}%</p>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection

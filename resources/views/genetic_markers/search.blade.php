@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Affichage des messages d'erreur ou de succès uniquement après la soumission -->
        @if (request()->isMethod('get') && ($errors->any() || session('success')))
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

        <h3 class="mb-4">Recherche d'un Profil ADN autosome</h3>
        
        <!-- Formulaire pour la recherche -->
        <form action="{{ route('genetic_markers.search') }}" method="GET">
            <!-- Amel dropdown -->
            <div class="form-group mb-4">
                <label for="Amel">Amel</label>
                <select class="form-control" id="Amel" name="Amel">
                    <option value="" {{ request('Amel') === null ? 'selected' : '' }}>Sélectionner Amel</option>
                    <option value="XX" {{ request('Amel') === 'XX' ? 'selected' : '' }}>XX</option>
                    <option value="XY" {{ request('Amel') === 'XY' ? 'selected' : '' }}>XY</option>
                </select>
            </div>

            <!-- Champs de recherche -->
            <div class="form-row">
                @foreach([
                    'D3S1358', 'D1S1656', 'D6S1043', 'D13S317', 'Penta_E',
                    'D16S539', 'D18S51', 'D2S1338', 'DSF1PO', 'Penta_D',
                    'THO1', 'VWA', 'D21S11', 'D7S820', 'D55818',
                    'TPOX', 'D8S1179', 'D12S391', 'D19S433', 'FGA'
                ] as $marker)
                    <div class="form-group col-md-2 mb-3">
                        <label for="{{ $marker }}_a">{{ $marker }}</label>
                        <div class="input-group">
                            @foreach(['a', 'b', 'c'] as $suffix)
                                <input type="text" id="{{ $marker }}_{{ $suffix }}" name="{{ $marker }}_{{ $suffix }}" value="{{ request($marker . '_' . $suffix) }}" class="form-control form-control-sm" placeholder="{{ $suffix }}">
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <!-- Affichage des résultats seulement si un formulaire a été soumis et que des résultats existent -->
        @if (request()->isMethod('get') && request()->has('Amel'))
            @if($profiles->isEmpty())
                <p class="mt-4">Aucun profil génétique trouvé avec les critères spécifiés.</p>
            @else
                      <h4 class="mt-4">Résultats de la recherche</h4>

                <!-- Afficher le lien avec le code du profil uniquement -->
                <ul class="list-group mt-3">
                    @foreach ($profiles as $profile)
                        <li class="list-group-item">
                            <a href="{{ route('genetic-profiles.show', ['id' => $profile->id]) }}" class="btn btn-link">
    {{ $profile->code }}
</a>

                        </li>
                    @endforeach
                </ul>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $profiles->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection


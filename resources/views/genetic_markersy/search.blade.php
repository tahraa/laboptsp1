@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Display error or success messages -->
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

        <h3 class="mb-4">Recherche d'un Profil autosome</h3>
        
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

        <!-- Affichage des résultats -->
        @if(collect([
            'D3S1358_a', 'D3S1358_b', 'D3S1358_c',
            'D1S1656_a', 'D1S1656_b', 'D1S1656_c',
            'D6S1043_a', 'D6S1043_b', 'D6S1043_c',
            'D13S317_a', 'D13S317_b', 'D13S317_c',
            'Penta_E_a', 'Penta_E_b', 'Penta_E_c',
            'D16S539_a', 'D16S539_b', 'D16S539_c',
            'D18S51_a', 'D18S51_b', 'D18S51_c',
            'D2S1338_a', 'D2S1338_b', 'D2S1338_c',
            'DSF1PO_a', 'DSF1PO_b', 'DSF1PO_c',
            'Penta_D_a', 'Penta_D_b', 'Penta_D_c',
            'THO1_a', 'THO1_b', 'THO1_c',
            'VWA_a', 'VWA_b', 'VWA_c',
            'D21S11_a', 'D21S11_b', 'D21S11_c',
            'D7S820_a', 'D7S820_b', 'D7S820_c',
            'D55818_a', 'D55818_b', 'D55818_c',
            'TPOX_a', 'TPOX_b', 'TPOX_c',
            'D8S1179_a', 'D8S1179_b', 'D8S1179_c',
            'D12S391_a', 'D12S391_b', 'D12S391_c',
            'D19S433_a', 'D19S433_b', 'D19S433_c',
            'FGA_a', 'FGA_b', 'FGA_c',
            'Amel'
        ])->contains(fn($param) => request()->has($param)))
		
            @if($markers->isEmpty())
				  <pre>{{ dd($markers->toArray()) }}</pre>
                <p class="mt-4">Aucun marqueur génétique trouvé avec les critères spécifiés.</p>
            @else
                <!-- Affichage des IDs des marqueurs -->
                <h4 class="mt-4">Résultats de la recherche</h4>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- Ajoutez d'autres en-têtes de colonne si nécessaire -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($markers as $marker)
                            <tr>
                                <td>{{ $marker->id }}</td>
                                <!-- Affichez d'autres informations sur les marqueurs si nécessaire -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    </div>
</div>
@endsection

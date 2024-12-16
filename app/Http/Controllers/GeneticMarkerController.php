<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneticProfile;
use App\GeneticMarker;
use App\Affaire;
use Illuminate\Support\Facades\Session;

class GeneticMarkerController extends Controller
{
    public function create()
    {
        // Assurez-vous que les données du profil génétique sont en session
        $profileData = session('profileData');

        if (!$profileData) {
            return redirect()->route('genetic-profiles.create')->withErrors('Erreur : données du profil manquantes.');
        }

        // Passer les données du profil à la vue
        return view('genetic_markers.create', ['profileData' => $profileData]);
    }

    public function store(Request $request)
    {
     // Valider les marqueurs
$request->validate([
    'D3S1358_a' => 'nullable|numeric|between:0,99.9',
    'D3S1358_b' => 'nullable|numeric|between:0,99.9',
    'D3S1358_c' => 'nullable|numeric|between:0,99.9',
    
    'D1S1656_a' => 'nullable|numeric|between:0,99.9',
    'D1S1656_b' => 'nullable|numeric|between:0,99.9',
    'D1S1656_c' => 'nullable|numeric|between:0,99.9',
    
    'D6S1043_a' => 'nullable|numeric|between:0,99.9',
    'D6S1043_b' => 'nullable|numeric|between:0,99.9',
    'D6S1043_c' => 'nullable|numeric|between:0,99.9',
    
    'D13S317_a' => 'nullable|numeric|between:0,99.9',
    'D13S317_b' => 'nullable|numeric|between:0,99.9',
    'D13S317_c' => 'nullable|numeric|between:0,99.9',
    
    'Penta_E_a' => 'nullable|numeric|between:0,99.9',
    'Penta_E_b' => 'nullable|numeric|between:0,99.9',
    'Penta_E_c' => 'nullable|numeric|between:0,99.9',
    
    'D16S539_a' => 'nullable|numeric|between:0,99.9',
    'D16S539_b' => 'nullable|numeric|between:0,99.9',
    'D16S539_c' => 'nullable|numeric|between:0,99.9',
    
    'D18S51_a' => 'nullable|numeric|between:0,99.9',
    'D18S51_b' => 'nullable|numeric|between:0,99.9',
    'D18S51_c' => 'nullable|numeric|between:0,99.9',
    
    'D2S1338_a' => 'nullable|numeric|between:0,99.9',
    'D2S1338_b' => 'nullable|numeric|between:0,99.9',
    'D2S1338_c' => 'nullable|numeric|between:0,99.9',
    
    'DSF1PO_a' => 'nullable|numeric|between:0,99.9',
    'DSF1PO_b' => 'nullable|numeric|between:0,99.9',
    'DSF1PO_c' => 'nullable|numeric|between:0,99.9',
    
    'Penta_D_a' => 'nullable|numeric|between:0,99.9',
    'Penta_D_b' => 'nullable|numeric|between:0,99.9',
    'Penta_D_c' => 'nullable|numeric|between:0,99.9',
    
    'THO1_a' => 'nullable|numeric|between:0,99.9',
    'THO1_b' => 'nullable|numeric|between:0,99.9',
    'THO1_c' => 'nullable|numeric|between:0,99.9',
    
    'VWA_a' => 'nullable|numeric|between:0,99.9',
    'VWA_b' => 'nullable|numeric|between:0,99.9',
    'VWA_c' => 'nullable|numeric|between:0,99.9',
    
    'D21S11_a' => 'nullable|numeric|between:0,99.9',
    'D21S11_b' => 'nullable|numeric|between:0,99.9',
    'D21S11_c' => 'nullable|numeric|between:0,99.9',
    
    'D7S820_a' => 'nullable|numeric|between:0,99.9',
    'D7S820_b' => 'nullable|numeric|between:0,99.9',
    'D7S820_c' => 'nullable|numeric|between:0,99.9',
    
    'D55818_a' => 'nullable|numeric|between:0,99.9',
    'D55818_b' => 'nullable|numeric|between:0,99.9',
    'D55818_c' => 'nullable|numeric|between:0,99.9',
    
    'TPOX_a' => 'nullable|numeric|between:0,99.9',
    'TPOX_b' => 'nullable|numeric|between:0,99.9',
    'TPOX_c' => 'nullable|numeric|between:0,99.9',
    
    'D8S1179_a' => 'nullable|numeric|between:0,99.9',
    'D8S1179_b' => 'nullable|numeric|between:0,99.9',
    'D8S1179_c' => 'nullable|numeric|between:0,99.9',
    
    'D12S391_a' => 'nullable|numeric|between:0,99.9',
    'D12S391_b' => 'nullable|numeric|between:0,99.9',
    'D12S391_c' => 'nullable|numeric|between:0,99.9',
    
    'D19S433_a' => 'nullable|numeric|between:0,99.9',
    'D19S433_b' => 'nullable|numeric|between:0,99.9',
    'D19S433_c' => 'nullable|numeric|between:0,99.9',
    
    'FGA_a' => 'nullable|numeric|between:0,99.9',
    'FGA_b' => 'nullable|numeric|between:0,99.9',
    'FGA_c' => 'nullable|numeric|between:0,99.9',
	 'Amel' => 'required|in:XX,XY',
]);


        // Récupérer les données du profil génétique depuis la session
        $profileData = session('profileData');

        if (!$profileData) {
            return redirect()->route('genetic-profiles.create')->withErrors('Erreur : données du profil manquantes.');
        }

        // Récupérer l'ID du profil depuis les données de la session
        $profile_id = $profileData['id'] ?? null;

        if (!$profile_id) {
            return redirect()->route('genetic-profiles.create')->withErrors('Erreur : ID du profil manquant.');
        }

	$markers = collect($request->only([
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
		'FGA_a', 'FGA_b', 'FGA_c'
	]));

$markersWithPrefixA = $markers->filter(fn($value, $key) => str_ends_with($key, '_a'));

// Compter les marqueurs remplis avec le préfixe 'a'
$filledMarkersCount = $markersWithPrefixA->filter(fn($value) => !is_null($value) && $value !== '')->count();

// Filtrer les marqueurs avec le préfixe '_b'
$markersWithPrefixB = collect($markers)->filter(fn($value, $key) => str_ends_with($key, '_b'));
// Compter les marqueurs remplis avec le préfixe '_b'
$filledMarkersCountB = $markersWithPrefixB->filter(fn($value) => !is_null($value) && $value !== '')->count();

if ($filledMarkersCount < 20 || $filledMarkersCountB < 20) {
    return back()->withErrors(['markers' => 'Au moins 21 marqueurs doivent être remplis.']);
}

        // Enregistrer les marqueurs génétiques
        $geneticMarker = new GeneticMarker([
            'genetic_profile_id' => $profile_id,
            'D3S1358_a' => $request->input('D3S1358_a'),
            'D3S1358_b' => $request->input('D3S1358_b'),
            'D3S1358_c' => $request->input('D3S1358_c'),
            'D1S1656_a' => $request->input('D1S1656_a'),
            'D1S1656_b' => $request->input('D1S1656_b'),
            'D1S1656_c' => $request->input('D1S1656_c'),
            'D6S1043_a' => $request->input('D6S1043_a'),
            'D6S1043_b' => $request->input('D6S1043_b'),
            'D6S1043_c' => $request->input('D6S1043_c'),
            'D13S317_a' => $request->input('D13S317_a'),
            'D13S317_b' => $request->input('D13S317_b'),
            'D13S317_c' => $request->input('D13S317_c'),
            'Penta_E_a' => $request->input('Penta_E_a'),
            'Penta_E_b' => $request->input('Penta_E_b'),
            'Penta_E_c' => $request->input('Penta_E_c'),
            'D16S539_a' => $request->input('D16S539_a'),
            'D16S539_b' => $request->input('D16S539_b'),
            'D16S539_c' => $request->input('D16S539_c'),
            'D18S51_a' => $request->input('D18S51_a'),
            'D18S51_b' => $request->input('D18S51_b'),
            'D18S51_c' => $request->input('D18S51_c'),
            'D2S1338_a' => $request->input('D2S1338_a'),
            'D2S1338_b' => $request->input('D2S1338_b'),
            'D2S1338_c' => $request->input('D2S1338_c'),
            'DSF1PO_a' => $request->input('DSF1PO_a'),
            'DSF1PO_b' => $request->input('DSF1PO_b'),
            'DSF1PO_c' => $request->input('DSF1PO_c'),
            'Penta_D_a' => $request->input('Penta_D_a'),
            'Penta_D_b' => $request->input('Penta_D_b'),
            'Penta_D_c' => $request->input('Penta_D_c'),
            'THO1_a' => $request->input('THO1_a'),
            'THO1_b' => $request->input('THO1_b'),
            'THO1_c' => $request->input('THO1_c'),
            'VWA_a' => $request->input('VWA_a'),
            'VWA_b' => $request->input('VWA_b'),
            'VWA_c' => $request->input('VWA_c'),
            'D21S11_a' => $request->input('D21S11_a'),
            'D21S11_b' => $request->input('D21S11_b'),
            'D21S11_c' => $request->input('D21S11_c'),
            'D7S820_a' => $request->input('D7S820_a'),
            'D7S820_b' => $request->input('D7S820_b'),
            'D7S820_c' => $request->input('D7S820_c'),
            'D55818_a' => $request->input('D55818_a'),
            'D55818_b' => $request->input('D55818_b'),
            'D55818_c' => $request->input('D55818_c'),
            'TPOX_a' => $request->input('TPOX_a'),
            'TPOX_b' => $request->input('TPOX_b'),
            'TPOX_c' => $request->input('TPOX_c'),
            'D8S1179_a' => $request->input('D8S1179_a'),
            'D8S1179_b' => $request->input('D8S1179_b'),
            'D8S1179_c' => $request->input('D8S1179_c'),
            'D12S391_a' => $request->input('D12S391_a'),
            'D12S391_b' => $request->input('D12S391_b'),
            'D12S391_c' => $request->input('D12S391_c'),
            'D19S433_a' => $request->input('D19S433_a'),
            'D19S433_b' => $request->input('D19S433_b'),
            'D19S433_c' => $request->input('D19S433_c'),
            'FGA_a' => $request->input('FGA_a'),
            'FGA_b' => $request->input('FGA_b'),
            'FGA_c' => $request->input('FGA_c'), 'Amel' => $request->input('Amel')
        ]);
        
        $geneticMarker->save();

        session()->forget('profileData');

        return redirect()->route('genetic-profiles.index')->with('success', 'Marqueurs génétiques enregistrés avec succès.');
    }
	
public function show($id)
{
    $geneticMarker = GeneticMarker::where('id', $id)->first();

    if (!$geneticMarker) {
        return view('genetic_markers.show')->with('message', 'Aucun alléle autosomique trouvé pour ce profil.');
    }

    // Récupérer le profil génétique associé
    $profile = $geneticMarker->geneticProfile;

    return view('genetic_markers.show', ['geneticMarker' => $geneticMarker, 'profile' => $profile]);
}


 
public function searchForm()
{

    return view('genetic_markers.search');
}
public function search(Request $request)
{
    $markers = [
        'D3S1358', 'D1S1656', 'D6S1043', 'D13S317', 'Penta_E',
        'D16S539', 'D18S51', 'D2S1338', 'DSF1PO', 'Penta_D',
        'THO1', 'VWA', 'D21S11', 'D7S820', 'D55818',
        'TPOX', 'D8S1179', 'D12S391', 'D19S433', 'FGA'
    ];

    $suffixes = ['a', 'b', 'c'];
    $rules = 'numeric|between:0,99.9';
    $validatedMarkers = [];

    if ($request->isMethod('get')) {
        // Validation des marqueurs génétiques
        foreach ($markers as $marker) {
            $conditions = [];
            $hasValidValues = true;

            foreach ($suffixes as $suffix) {
                $key = "{$marker}_{$suffix}";

                if ($request->has($key) && $request->input($key) !== '') {
                    $value = $request->input($key);
                    $value = number_format((float)$value, 1, '.', ''); // Format à 1.0
                    $validator = \Validator::make(
                        [$key => $value],
                        [$key => $rules]
                    );

                    if ($validator->fails()) {
                        $hasValidValues = false;
                        break;
                    }

                    if ($suffix == 'a' || $suffix == 'b') {
                        $conditions[$suffix] = $value;
                    }
                }
            }

            // Vérification de la cohérence des valeurs pour les suffixes 'a' et 'b'
            if (isset($conditions['a']) && !isset($conditions['b'])) {
                return redirect()->back()->withErrors(['message' => "La valeur pour le marqueur {$marker} avec le suffixe 'b' est requise."])->withInput();
            }

            if (isset($conditions['b']) && !isset($conditions['a'])) {
                return redirect()->back()->withErrors(['message' => "La valeur pour le marqueur {$marker} avec le suffixe 'a' est requise."])->withInput();
            }

            if ($hasValidValues && isset($conditions['a']) && isset($conditions['b'])) {
                $validatedMarkers[$marker] = $conditions;
            }
        }

        $query = GeneticProfile::query();

        // Filtrage par Amel dans la table genetic_markers
        if ($request->has('Amel')) {
            $amel = $request->input('Amel');
            if (!empty($amel)) {
                $query->whereHas('geneticMarker', function ($q) use ($amel) {
                    $q->where('Amel', $amel);  // Filtrer par Amel dans genetic_markers
                });
            }
        }

        // Ajouter les conditions pour les marqueurs génétiques
        foreach ($validatedMarkers as $marker => $conditions) {
            $query->whereHas('geneticMarker', function ($q) use ($marker, $conditions) {
                $aValue = $conditions['a'] ?? null;
                $bValue = $conditions['b'] ?? null;
                $cValue = $conditions['c'] ?? null;

                if ($aValue) {
                    $q->where($marker . '_a', $aValue);
                }
                if ($bValue) {
                    $q->where($marker . '_b', $bValue);
                }
                if ($cValue) {
                    $q->where($marker . '_c', $cValue);
                }
            });
        }

        // Utilisation de paginate au lieu de get pour la pagination
        $profiles = $query->paginate(10);  

        // Passer les profils à la vue
        return view('genetic_markers.search', ['profiles' => $profiles]);
    }
}





}


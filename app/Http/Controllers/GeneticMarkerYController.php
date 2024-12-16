<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfilY;
use App\GeneticProfile;
use Illuminate\Support\Facades\DB;
class GeneticMarkerYController extends Controller
{
public function create()
{
    // Récupérer les données du profil génétique depuis la session
    $profileData = session('profileData');

    // Vérifier la présence des données du profil et de l'ID
    if (!$profileData || !isset($profileData['id'])) {
        return redirect()->route('genetic-profiles.create')
            ->withErrors('Erreur : données du profil manquantes ou ID invalide.');
    }

    // Passer les données à la vue
    return view('genetic_markersy.create', ['profileData' => $profileData]);
}
public function store(Request $request)
{
    // Liste des marqueurs à traiter
    $markers = [
        'DYS576', 'DYS389I', 'DYS448', 'DYS389II', 'DYS19', 'DYS391', 'DYS481',
        'DYS549', 'DY533', 'DY438', 'DY437', 'DYS570', 'DYS635', 'DYS390', 'DYS439',
        'DYS392', 'DYS643', 'DYS393', 'DYS458', 'DYS385', 'DYS456', 'YGATAH4',
    ];

    // Validation dynamique
    $validationRules = [];
    foreach ($markers as $marker) {
        $validationRules["{$marker}_a"] = 'nullable|numeric|between:0,99.9';
        $validationRules["{$marker}_b"] = 'nullable|numeric|between:0,99.9|required_if:' . "{$marker}_a" . ',!=,null';
    }

    // Valider la requête
    $validated = $request->validate($validationRules);

    // Vérifier et récupérer les données du profil
    $profileData = session('profileData');
    if (!$profileData || !isset($profileData['id'])) {
        return redirect()->route('genetic-profiles.create')
            ->withErrors('Erreur : Le profil génétique est manquant ou l\'ID est invalide.');
    }

    // Préparer les données à enregistrer
    $geneticMarkerData = [];
    foreach ($markers as $marker) {
        // Récupérer les valeurs de a et b
        $valueA = $request->input("{$marker}_a");
        $valueB = $request->input("{$marker}_b");

        // Combiner a et b en une seule valeur
        if ($valueA !== null && $valueB !== null) {
            $geneticMarkerData[$marker] = $valueA . ',' . $valueB;
        } else {
            $geneticMarkerData[$marker] = null; // ou une valeur par défaut si nécessaire
        }
    }

    $geneticMarkerData['genetic_profile_id'] = $profileData['id'];

    // Enregistrer les données dans la base de données
    ProfilY::create($geneticMarkerData);

    return redirect()->route('genetic-profiles.index')->with('success', 'Marqueurs Y enregistrés avec succès.');
}


public function show($id)
{
   $geneticMarker = ProfilY::where('genetic_profile_id', $id)->first();


    if (!$geneticMarker) {
        return view('genetic_markersy.show')->with('message', 'Aucun alléle autosomique trouvé pour ce profil.');
    }

    $profile = $geneticMarker->geneticProfile;

    return view('genetic_markersy.show', ['geneticMarker' => $geneticMarker, 'profile' => $profile]);
}



public function search(Request $request)
{
    // Liste des marqueurs génétiques
    $markers = [
        'DYS576', 'DYS389I', 'DYS448', 'DYS389II', 'DYS19', 'DYS391', 'DYS481',
        'DYS549', 'DY533', 'DY438', 'DY437', 'DYS570', 'DYS635', 'DYS390', 'DYS439',
        'DYS392', 'DYS643', 'DYS393', 'DYS458', 'DYS385', 'DYS456', 'YGATAH4',
    ];

    // Validation des données de recherche
    $validationRules = [];
    foreach ($markers as $marker) {
        $validationRules["{$marker}_a"] = 'nullable|numeric|between:0,99.9';
        $validationRules["{$marker}_b"] = 'nullable|numeric|between:0,99.9';
    }

    $request->validate($validationRules);

    // Collecte des données de recherche
    $searchData = [];
    foreach ($markers as $marker) {
        $searchA = $request->input("{$marker}_a");
        $searchB = $request->input("{$marker}_b");

        // Si les deux valeurs sont présentes, les concaténer en une seule chaîne
        if ($searchA !== null && $searchB !== null) {
            $searchData[$marker] = "$searchA,$searchB";
        } elseif ($searchA !== null) {
            $searchData[$marker] = $searchA;
        } elseif ($searchB !== null) {
            $searchData[$marker] = $searchB;
        }
    }

    // Vérifier que l'utilisateur a saisi au moins 11 marqueurs
    $totalPairs = count($searchData);
    if ($totalPairs < 11) {
        $message = 'Vous devez saisir au moins 11 marqueurs pour effectuer la comparaison.';
        return view('genetic_markersy.search', [
            'message' => $message,
            'matches' => 0,
            'totalPairs' => $totalPairs,
            'matchPercentage' => null,
        ]);
    }

    // Récupérer tous les profils dans la base de données
    $matchingProfiles = ProfilY::all();

    // Variables pour les correspondances
    $matchingProfilesWithCount = [];

    // Comparer chaque profil pour vérifier les correspondances sur au moins 11 marqueurs
    foreach ($matchingProfiles as $profile) {
        $profileMatchingCount = 0;

        // Comparaison des marqueurs
        foreach ($markers as $marker) {
            if (isset($searchData[$marker])) {
                $value = $searchData[$marker];
                $profileValue = $profile->$marker;

                // Vérification si la valeur correspond
                if ($profileValue == $value) {
                    $profileMatchingCount++;
                }
            }
        }

        // Si le profil correspond à au moins 11 marqueurs, ajouter son ID
        if ($profileMatchingCount >= 11) {
            $matchingProfilesWithCount[] = [
                'profile_id' => $profile->genetic_profile_id, // ID du profil
                'matching_count' => $profileMatchingCount, // Nombre de marqueurs correspondants
            ];
        }
    }

    // Si aucun profil ne correspond à au moins 11 marqueurs
    if (count($matchingProfilesWithCount) === 0) {
        $message = 'Aucun profil génétique ne correspond à au moins 11 marqueurs.';
        return view('genetic_markersy.search', [
            'message' => $message,
            'matches' => 0,
            'totalPairs' => $totalPairs,
            'matchPercentage' => null,
        ]);
    }

    // Message de correspondance
    $message = 'Des profils génétiques avec au moins 13 marqueurs ont été trouvés.';
    
    // Afficher le nombre de profils correspondants
    $numberOfMatches = count($matchingProfilesWithCount);

    return view('genetic_markersy.search', [
        'message' => $message,
        'matchingProfiles' => $matchingProfilesWithCount,  // Liste des profils correspondants
        'matches' => $numberOfMatches,  // Nombre de profils correspondants
        'totalPairs' => $totalPairs,
        'matchPercentage' => null,
    ]);
}








}

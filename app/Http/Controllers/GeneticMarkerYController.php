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
        $geneticMarkerData["{$marker}_a"] = $request->input("{$marker}_a");
        $geneticMarkerData["{$marker}_b"] = $request->input("{$marker}_b");
    }

    $geneticMarkerData['genetic_profile_id'] = $profileData['id'];

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
    // Liste des marqueurs à comparer
    $markers = [
        'DYS576', 'DYS389I', 'DYS448', 'DYS389II', 'DYS19', 'DYS391', 'DYS481',
        'DYS549', 'DY533', 'DY438', 'DY437', 'DYS570', 'DYS635', 'DYS390', 'DYS439',
        'DYS392', 'DYS643', 'DYS393', 'DYS458', 'DYS385', 'DYS456', 'YGATAH4',
    ];

    // Récupération des valeurs à comparer depuis la requête (GET)
    $inputValues = $request->all();

    // Total des paires de marqueurs à comparer
    $totalPairs = count($markers);

    // Compteur des correspondances
    $matches = 0;

    // Parcourir chaque marqueur pour comparaison
    foreach ($markers as $marker) {
        $marker_a = $inputValues["{$marker}_a"] ?? null;
        $marker_b = $inputValues["{$marker}_b"] ?? null;

        // Vérifier si les deux valeurs sont présentes
        if ($marker_a && $marker_b) {
            // Comparer les paires de marqueurs
            if ($this->compareMarkers($marker_a, $marker_b)) {
                $matches++;
            }
        }
    }

    // Calculer le pourcentage de correspondance
    $matchPercentage = ($matches / $totalPairs) * 100;

    // Vérifier si le pourcentage de correspondance est supérieur ou égal à 50%
    if ($matchPercentage >= 50) {
        $message = "Correspondance trouvée avec un taux de $matchPercentage%";
    } else {
        $message = "Aucune correspondance trouvée.";
    }

    return view('genetic_markersy.search_results', compact('message', 'matches', 'totalPairs', 'matchPercentage'));
}



}
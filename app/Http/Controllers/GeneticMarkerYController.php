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

    // Générer dynamiquement les règles de validation pour chaque marqueur
    $validationRules = [];
    foreach ($markers as $marker) {
        $validationRules["{$marker}_a"] = 'nullable|numeric|between:0,99.9';
        $validationRules["{$marker}_b"] = 'nullable|numeric|between:0,99.9';
    }

    // Valider les entrées du formulaire avec les règles générées dynamiquement
    $request->validate($validationRules);

    // Récupérer les valeurs des marqueurs génétiques saisies et les combiner sous la forme "12,13"
    $searchData = [];
    foreach ($markers as $marker) {
        $searchA = $request->input("{$marker}_a");
        $searchB = $request->input("{$marker}_b");

        // Si les deux valeurs sont saisies, on les combine avec une virgule
        if ($searchA !== null && $searchB !== null) {
            $searchData[$marker] = $searchA . ',' . $searchB;
        } elseif ($searchA !== null) {
            $searchData[$marker] = $searchA;
        } elseif ($searchB !== null) {
            $searchData[$marker] = $searchB;
        }
    }

    // Initialiser la requête de recherche
    $query = ProfilY::query();

    // Filtrer par les marqueurs saisis
    foreach ($markers as $marker) {
        if (isset($searchData[$marker])) {
            $value = $searchData[$marker];

            // Recherche avec "LIKE" pour comparer la chaîne (par exemple "12,13")
            $query->where(function ($q) use ($marker, $value) {
                $q->where($marker, 'like', "%$value%");
            });
        }
    }

    // Exécuter la requête pour obtenir les profils correspondant
    $matchingProfiles = $query->get();

    // Définir le nombre total de paires de marqueurs qui ont été saisies
    $totalPairs = count(array_filter($searchData, fn($value) => $value !== null)); // Nombre de marqueurs pour lesquels des valeurs ont été saisies

    // Calculer la correspondance
    $matchingCount = 0;
    foreach ($matchingProfiles as $profile) {
        $profileMatchingCount = 0;

        // Pour chaque profil, comparer chaque marqueur saisi
        foreach ($markers as $marker) {
            if (isset($searchData[$marker])) {
                $value = $searchData[$marker];
                $profileValue = $profile->getAttribute($marker); // Valeur enregistrée dans la base

                // Vérifier si la valeur saisie correspond à la valeur dans la base de données (avec "LIKE")
                if (strpos($profileValue, $value) !== false) {
                    $profileMatchingCount++;
                }
            }
        }

        // Si le profil correspond à plus de 50% des marqueurs, l'ajouter aux correspondances
        if ($profileMatchingCount / $totalPairs >= 0.5) {
            $matchingCount++;
        }
    }

    // Si des correspondances sont trouvées
    if ($matchingCount === 0) {
        $message = 'Aucun profil génétique ne correspond à plus de 50%.';
        $matchPercentage = null;
        $matches = 0;
    } else {
        $message = 'Des profils génétiques avec plus de 50% de correspondance ont été trouvés.';
        $matches = $matchingCount;

        // Calculer le pourcentage de correspondance
        $matchPercentage = ($matchingCount / $totalPairs) * 100;
    }

    return view('genetic_markersy.search', [
        'message' => $message,
        'matches' => $matches,
        'totalPairs' => $totalPairs,
        'matchPercentage' => $matchPercentage,
    ]);
}








}
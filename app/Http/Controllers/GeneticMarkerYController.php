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
        $markers = [
            'DYS576', 'DYS389I', 'DYS448', 'DYS389II', 'DYS19', 'DYS391', 
            'DYS481', 'DYS549', 'DY533', 'DY438', 'DY437', 'DYS570', 
            'DYS635', 'DYS390', 'DYS439', 'DYS392', 'DYS643', 'DYS393', 
            'DYS458', 'DYS385', 'DYS456', 'YGATAH4',
        ];

        $validatedMarkers = [];
        $suffixes = ['a', 'b'];
        $rules = 'numeric|between:0,99.9';

        foreach ($markers as $marker) {
            $conditions = [];
            $hasValidConditions = false;

            foreach ($suffixes as $suffix) {
                $key = "{$marker}_{$suffix}";

                if ($request->has($key) && $request->input($key) !== '') {
                    $value = $request->input($key);
                    $validator = \Validator::make(
                        [$key => $value],
                        [$key => $rules]
                    );

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $conditions[$suffix] = $value;
                    $hasValidConditions = true;
                }
            }

            if ($hasValidConditions && isset($conditions['a']) && isset($conditions['b'])) {
                $validatedMarkers[$marker] = $conditions;
            }
        }

        $query =ProfilY::query();

        foreach ($validatedMarkers as $marker => $conditions) {
            $query->where(function ($q) use ($marker, $conditions) {
                $aValue = $conditions['a'] ?? null;
                $bValue = $conditions['b'] ?? null;

                if ($aValue) {
                    $q->where($marker . '_a', $aValue);
                }
                if ($bValue) {
                    $q->where($marker . '_b', $bValue);
                }
            });
        }

        $markers = $query->get();

        return view('genetic_markersy.search', ['markers' => $markers]);
    }
}

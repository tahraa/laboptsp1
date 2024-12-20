<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneticProfile;
use App\GeneticMarker;
use App\Affaire;
use Illuminate\Support\Facades\Session; // Assurez-vous que cette ligne est présente
use Illuminate\Support\Facades\DB;
class GeneticProfileController extends Controller
{
public function create()
{
    $affaires = Affaire::all(); 
   
    return view('genetic_profiles.create', compact('affaires'));
}
public function store(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'affaire_id' => 'required|not_in:vide',
        'nni' => 'nullable|digits:10|unique:genetic_profiles',
        'code' => 'required|string|unique:genetic_profiles',
    ]);

    // Récupérer l'affaire associée pour obtenir le type
    $affaire = Affaire::find($request->input('affaire_id'));

    // Déterminer le motif_nom pour les profils inconnus
    $motif_nom = $request->input('motif_nom');
    $is_known = $request->input('is_known', false);
    if (!$is_known && $affaire) {
        $motif_nom = $affaire->type;
    }

    // Créer le profil génétique
    $geneticProfile = GeneticProfile::create([
        'code' => $request->input('code'),
        'affaire_id' => $request->input('affaire_id'),
        'prenom' => $request->input('prenom'),
        'nom' => $request->input('nom'),
        'nni' => $request->input('nni'),
        'nomcriminel' => $request->input('nomcriminel'),
        'date_naissance' => $request->input('date_naissance'),
        'lieu_naissance' => $request->input('lieu_naissance'),
        'motif_nom' => $motif_nom,
        'is_known' => $is_known,
    ]);

    // Attacher le profil génétique à l'affaire dans la table de jointure
    $geneticProfile->affaires()->attach($request->input('affaire_id'));

    // Stocker les données du profil en session pour les utiliser lors de la création des marqueurs génétiques
    session(['profileData' => [
        'id' => $geneticProfile->id, // Ajout de l'ID
        'code' => $request->input('code'),
        'affaire_id' => $request->input('affaire_id'),
        'prenom' => $request->input('prenom'),
        'nom' => $request->input('nom'),
        'nni' => $request->input('nni'),
        'nomcriminel' => $request->input('nomcriminel'),
        'date_naissance' => $request->input('date_naissance'),
        'lieu_naissance' => $request->input('lieu_naissance'),
        'motif_nom' => $motif_nom,
        'is_known' => $is_known,
    ]]);

    // Déterminer le type de marqueurs à créer en fonction du bouton pressé
    $markerType = $request->input('marker_type', 'autosome');

    if ($markerType === 'y') {
        // Rediriger vers la route pour créer des marqueurs Y
        return redirect()->route('y-markers.create')
            ->with('success', 'Veuillez ajouter les allèles gonosomiques Y.');
    } else {
        // Rediriger vers la route pour créer des marqueurs autosomiques
        return redirect()->route('genetic-markers.create')
            ->with('success', 'Veuillez ajouter les allèles génétiques de l autosome.');
    }
}


public function show($id)
{
    // Charge la relation affaire avec le profil génétique
    $profile = GeneticProfile::with('affaires','geneticMarker','profilY')->findOrFail($id);
    
    // Construire le chemin de l'image
    $imagePath = public_path('images/' . $profile->nni . '.jpg');  // Utilise l'extension .jpg
    
    // Vérifier si l'image existe
    $imageExists = file_exists($imagePath);
    
  
    $affaires = $profile->affaires; 
    $geneticMarker = $profile->geneticMarker;
    $profilY = $profile->profilY;

    return view('genetic_profiles.show', compact('profile', 'imageExists', 'imagePath', 'affaires', 'geneticMarker', 'profilY'));}



  public function index()
{
    $user_id = auth()->user()->id;

      // Profils connus
      $knownProfiles = GeneticProfile::with(['geneticMarker', 'affaires', 'profilY'])
      ->where('is_known', true)
      ->orderBy('code', 'desc')
      ->paginate(500); // Pagination avec Eloquent
// Profils inconnus
$unknownProfiles = GeneticProfile::with(['geneticMarker', 'affaires', 'profilY'])
->where('is_known', false)
->orderBy('code', 'desc')
->paginate(500); 
$count_profiles = GeneticProfile::count();

return view('genetic_profiles.index', [
'knownProfiles' => $knownProfiles,
'unknownProfiles' => $unknownProfiles,
'count_profiles' => $count_profiles,
]);
}


 

public function searchForm()
{

    return view('genetic_profiles.search');
}
public function search(Request $request)
{
    $query = GeneticProfile::query();

    if ($request->filled('code')) {
        $query->where('code', '=', $request->input('code'));
    }
    if ($request->filled('nom')) {
        $query->where('nom', 'like', '%' . $request->input('nom') . '%');
    }
    if ($request->filled('prenom')) {
        $query->where('prenom', 'like', '%' . $request->input('prenom') . '%');
    }

    if ($request->filled('nni')) {
        $nni = $request->input('nni');
        $query->where('nni', '=', $nni);
    }

    // Récupérer les profils et paginer
    $profiles = $query->paginate(10);

    // Retourner la vue avec les profils
    return view('genetic_profiles.search', compact('profiles'));
}





   
  
}


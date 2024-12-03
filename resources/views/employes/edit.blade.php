@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')

        <div class="card-header text-primary"><h2>Modifier/Affaire</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('employes.update', ['employe'=>$employe->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                <p class="card-header text-primary">Affaire:  Nbre intervenants: {{ $employe->intervenants_count }}   Documents:    @if ($employe->rapports_count == '1')
                    <i class="fas fa-check"></i> OUI
                    @endif
                    @if ($employe->rapports_count == '0')
                    <i class="fas fa-times"></i> NON
                    @endif</p>
                    <p> </p>
                <div class="table-responsive">

                        <div class="form-group">
                          <label for="mt">Numéro d'Affaire</label>
                          <input  maxlength="6" required="required" type="text" name="num_affaire"  class="form-control" value="{{ old('num_affaire', $employe->num_affaire ?? null) }}"/></td>
                        </div>

                        <div class="form-group">
                          <label for="nni">Type</label>
                          <input id="nni" required="required" type="text" name="type"  class="form-control" value="{{ old('type', $employe->type ?? null) }}"/>
                        </div>


                        <div class="form-group">
                          <label for="dn">Date de réception</label>
                          <input id="dn" required="required"  type="date" name="date" class="form-control" value="{{ old('date', $employe->date) }}"/>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Lieu d'infraction</label>
                            <input id="prenom" type="text" name="lieu_crime"  class="form-control" value="{{ old('lieu d\'intervention', $employe->lieu_crime?? null) }}"/>
                          </div>
                          <div class="form-group">
                            <label for="nom">Référence</label>
                            <input id="nom" required="required" type="text" name="reference"  class="form-control" value="{{ old('référence', $employe->reference ?? null) }}"/>
                          </div>
						         <div class="form-group">
                            <label for="nom">Date et periode d'intervention</label>
                            <input id="nom"  type="text" name="periode"  class="form-control" value="{{ old('periode', $employe->periode ?? null) }}"/>
                          </div>
                        <div class="form-group">
                            <label for="dn">Date de prélèvement</label>
                            <input id="dn"   type="date" name="date_prelevement" class="form-control" value="{{ old('date_prelevement', $employe->date_prelevement) }}"/>
                          </div>
                          <div class="form-group">
                            <label for="dn">Lieu de prélèvement</label>
                            <input id="dn"  type="text" name="lieu_prelevement" class="form-control" value="{{ old('lieu_prelevement', $employe->lieu_prelevement) }}"/>
                          </div>

                          <div class="form-group">
                            <label for="mt">Numéro d'affaire dans le commissariat</label>
                            <input type="text" name="num_affaire_c"  class="form-control" value="{{ old('num_affaire_c', $employe->num_affaire_c ?? null) }}"/></td>
                          </div>

                          <div class="form-group">
                            <label for="mt">Victime</label>
                            <input   type="text" name="victim"  class="form-control" value="{{ old('victim', $employe->victim ?? null) }}"/></td>
                          </div>
                        
						<div class="form-group">
                            <label for="mt">Numéro Rapport(s)</label>
                            <input   type="text" name="num_rapport"  class="form-control" value="{{ old('num_rapport', $employe->num_rapport ?? null) }}"/></td>
                          </div>

                          <div class="form-group">
                            <label for="mt">Numéro Soit(s) transmis</label>
                            <input  type="text" name="num_soit"  class="form-control" value="{{ old('num_soit', $employe->num_soit ?? null) }}"/></td>
                          </div>


   <div class="form-group">
                          <label for="region">Résultat</label>
                        <select  id="resultat" type="text" name="resultat" class="form-control"><option value={{ old('resultat', $employe->resultat ?? null) }}></option><option value="1">Positive</option>
</select >
                        </div>


                      




                <div>
                    <button type="submit" class="btn btn-success">Modifier</button>
            </form>
        </div>
        @else
        <div class="alert alert-warning" role="alert">
        Vous n'avez pas l'accès à cette page.
        </div>
        @php
            header("Location: " . URL::to('/'), true, 302);
            exit();
        @endphp
    @endif
    </div>
</div>
@endsection

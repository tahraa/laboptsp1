@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
      
        <div class="card-header text-primary"><h2>Modifier/Employé</h2>
        </div>
        <div class="card-body">
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
                <p>Employé:  nombre couple : {{ $employe->couples_count }}   nombre enfants : {{ $employe->enfants_count }}</p>
                <div class="table-responsive">
                    <table class="table table-bordered" id="">
                        <tr>
                            <th>matricule</th>
                            <th>nni</th>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>date_naissance</th>
                            <th>statut</th>
                            <th>sexe</th>
                            <th>photo</th>
                        </tr>
                        <tr>
                            <td><input  style="width:150px" required="required" type="text" name="matricule" placeholder="Enter matricule" class="form-control" value="{{ old('matricule', $employe->matricule ?? null) }}"/></td>
                            <td><input style="width:150px" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni', $employe->nni ?? null) }}"/></td>
                            <td><input style="width:150px" required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom', $employe->nom ?? null) }}"/></td>
                            <td><input style="width:150px" required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom', $employe->prenom ?? null) }}"/></td>
                            <td><input style="width: 200px" required="required"  type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', $employe->date_naissance ?? null) }}" /></td>
                            <td><select style="width:150px"  required="required" name="statut" id="" class="form-control"><option {{ $employe->statut ? 'selected' : '' }} value="1"  >assuré</option><option value="0" {{ !$employe->statut ? 'selected' : '' }} >non assuré</option></select></td>
                            <td><select style="width:150px" required="required" name="sexe" id="" class="form-control"><option {{ $employe->sexe == 'masculin' ? 'selected' : '' }}  value="masculin">masculin</option><option {{ $employe->sexe == 'feminin'  ? 'selected' : '' }} value="feminin">féminin</option></select></td>
                            <td><input style="width:300px"  type="file" name="emp_image" class="form-control" value=""/></td>
                        </tr>
                    </table>
                </div>
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
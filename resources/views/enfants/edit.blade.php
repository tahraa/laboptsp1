@extends('layout')
@section('content')
@php
$user_id = auth()->user()->id;
$user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
      
        <div class="card-header"><h2>Modifier/Enfant</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('enfants.update', ['enfant'=>$enfant->id]) }}" method="POST" enctype="multipart/form-data">
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
                <div class="table-responsive">

                
                <table class="table table-bordered" id="">
                    <tr>
                        <th>nni</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>statut</th>
                        <th>sexe</th>
                        <th>photo</th>
                    </tr>
                    <tr>
                        <td><input style="width: 200px" maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni', $enfant->nni ?? null) }}"/></td>
                        <td><input style="width: 200px" required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom', $enfant->nom ?? null) }}"/></td>
                        <td><input style="width: 200px" required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom', $enfant->prenom ?? null) }}"/></td>
                        <td><select style="width: 200px" required="required" name="statut" id="" class="form-control"><option {{ $enfant->statut ? 'selected' : '' }} value="1"  >assuré</option><option value="0" {{ !$enfant->statut ? 'selected' : '' }} >non assuré</option></select></td>
                        <td><select style="width: 200px" required="required" name="sexe" id="" class="form-control"><option {{ $enfant->sexe == 'masculin' ? 'selected' : '' }}  value="masculin">masculin</option><option {{ $enfant->sexe == 'feminin'  ? 'selected' : '' }} value="feminin">féminin</option></select></td>
                        <td><input style="width: 200px" style="width: 200px" required="required"  type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', $enfant->date_naissance ?? null) }}"/></td>
                        <td>
                            <select style="width: 125px"  required="required" name="scolarite" class="form-control">
                               <option {{ $enfant->scolarite ? 'selected' : '' }} value="1">Scolarisé</option>
                               <option {{ !$enfant->scolarite ? 'selected' : '' }} value="0">Non Scolarisé</option>
                            </select>
                        </td>
                        <td><input style="width: 400px"  type="file" name="e_image" class="form-control" value="{{ old('e_image') }}"/></td>
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

@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
<div class="card mt-3">
  @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')

  <div class="card-header text-primary"><h2>Ajouter/livret</h2></div>
  <div class="card-body">
<form action="{{ route('employes.store') }}" method="POST" enctype="multipart/form-data" >
@csrf
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@if(Session::has('success'))
<div class="alert alert-success text-center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  <p>{{ Session::get('success') }}</p>
</div>
@endif
<p class="text-primary">Employé:</p>
  <div class="table-responsive">
  <table class="table table-bordered table-responsive" id="" style="width: 100%">
    <tr>
      <th>matricule</th>
      <th>nni</th>
      <th>nom</th>
      <th>prenom</th>
      <th>statut</th>
      <th>sexe</th>
      <th>n°cnam</th>
      <th>date naissance</th>
      <th>service</th>
      <th>ets</th>
      <th>photo</th>
    </tr>
    <tr>
      <td><input style="width: 160px" maxlength="5" required="required" type="text" name="matricule" placeholder="Enter matricule" class="form-control" value="{{ old('matricule') }}"/></td>
      <td><input style="width: 125px" maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni') }}"/></td>
      <td><input style="width: 125px" required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom') }}"/></td>
      <td><input  style="width: 125px"required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom') }}"/></td>
      <td><select style="width: 125px" required="required" name="statut" id="" class="form-control"><option {{ old('statut') == true ? 'selected' : '' }} value="1">assuré</option><option {{ old('statut') == false ? 'selected' : '' }}  value="0">non assuré</option></select></td>
      <td><select style="width: 125px" required="required" name="sexe" id="" class="form-control"><option {{ old('sexe') == 'masculin' ? 'selected' : '' }} value="masculin">masculin</option><option {{ old('sexe') == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select></td>
      <td><input style="width: 200px" maxlength="8" type="text" name="num_cnam" placeholder="Enter num_cnam" class="form-control" value="{{ old('num_cnam') }}"/></td>
      <td><input style="width: 200px" required="required"  type="date" name="date_naissance" class="form-control" /></td>
      <td><input style="width: 200px" maxlength="6" required="required"  type="text" name="service" class="form-control" value="{{ old('service') }}" /> </td>
      <td>
          <select style="width: 200px" name="etablissement" id="ets" class="form-control" required>
            <option value="NDB">NDB</option>
            <option value="ZTE">ZTE</option>
          </select>
      </td>
      <td><input style="width: 300px" required="required" type="file" name="emp_image" class="form-control" value="{{ old('emp_image') }}"/></td>
    </table>
  </div>
    <p class="text-primary">CONJOINT(s)</p>
    <div class="table-responsive">
      <table class="table table-bordered" id="dynamicAddRemoveC">
        <tr>
          <th>nni</th>
          <th>nom</th>
          <th>prenom</th>
          <th>statut</th>
          <th>n°cnam</th>
          <th>date naissance</th>
          <th>date mariage</th>
          <th>photo</th>
          <th>action</th>
        </tr>
        <tr>
          <td><input style="width: 160px" maxlength="10" required="required" type="text" name="moreFieldsC[0][nni]" placeholder="Enter nni" class="form-control" value="{{old('moreFieldsC[0][nni]')}}"/></td>
          <td><input style="width: 160px" required="required" type="text" name="moreFieldsC[0][nom]" placeholder="Enter nom" class="form-control" value="{{old('moreFieldsC[0][nom]')}}"/></td>
          <td><input style="width: 160px" required="required" type="text" name="moreFieldsC[0][prenom]" placeholder="Enter prénom" class="form-control" value="{{ old('moreFieldsC[0][prenom]') }}"/></td>
          <td><select style="width: 160px" required="required" name="moreFieldsC[0][statut]" id="" class="form-control"><option value="1">assuré</option><option value="0">non assuré</option></select></td>
          <td><input style="width: 125px"  maxlength="8" type="text" name="moreFieldsC[0][num_cnam]" placeholder="Enter num_cnam" class="form-control" value="{{ old('num_cnam') }}"/></td>
          <td><input style="width: 200px" required="required"  type="date" name="moreFieldsC[0][date_naissance]" class="form-control" /></td>
          <td><input style="width: 200px" required="required"  type="date" name="moreFieldsC[0][date_mariage]" class="form-control" /></td>
          <td><input style="width: 300px" required="required" type="file" name="moreFieldsC[0][couple_image]" class="form-control" value=""/></td>
          <td><button type="button" name="add" id="add-btnC" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
        </tr>
      </table>
    </div>

    <div>a enfant(s)?</div>
    <label for="chkYes">
      <input type="radio" id="chkYes" name="genre" value="1"/> Oui
    </label>
    <label for="chkNo">
      <input checked type="radio" id="chkNo" name="genre" value="0"/> Non
    </label>
    <hr>
    <div id="dvPinNo" style="display: none">
      <p class="text-primary">Enfant(s)</p>
      <div class="table-responsive">
        <table class="table table-bordered" id="dynamicAddRemoveE">
          <tr>
            <th>nni</th>
            <th>nom</th>
            <th>prenom</th>
            <th>statut</th>
            <th>etude</th>
            <th>sexe</th>
            <th>n°cnam</th>
            <th>date naissance</th>
            <th>photo</th>
            <th>action</th>
          </tr>
          <tr>
            <td><input style="width: 160px" value="{{old('moreFieldsE[0][nni]')}}" maxlength="10" type="text" name="moreFieldsE[0][nni]" placeholder="Enter nni" class="form-control" /></td>
            <td><input style="width: 160px" value="{{old('moreFieldsE[0][nom]')}}" type="text" name="moreFieldsE[0][nom]" placeholder="Enter nom" class="form-control" /></td>
            <td><input style="width: 160px" value="{{old('moreFieldsE[0][prenom]')}}" type="text" name="moreFieldsE[0][prenom]" placeholder="Enter prénom" class="form-control" /></td>
            <td><select style="width: 160px" name="moreFieldsE[0][statut]" id="" class="form-control"><option {{ old('moreFieldsE[0][statut]') == '1' ? 'selected' : '' }} value="1">assuré</option><option {{ old('moreFieldsE[0][statut]') == '0' ? 'selected' : '' }} value="0">non assuré</option></select></td>
            <td><select style="width: 160px"  name="moreFieldsE[0][scolarite]" id="" class="form-control"><option value="1">scolarisé</option><option value="0">non scolarisé</option></select></td>
            <td><select style="width: 160px" name="moreFieldsE[0][sexe]" id="" class="form-control"><option {{ old('moreFieldsE[0][sexe]') == 'masculin' ? 'selected' : '' }} value="masculin">masculin</option><option {{ old('moreFieldsE[0][sexe]') == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select></td>
            <td><input style="width: 125px"  maxlength="8" type="text" name="moreFieldsE[0][num_cnam]" placeholder="Enter num_cnam" class="form-control" value="{{ old('num_cnam') }}"/></td>
            <td><input style="width: 200px"   type="date" name="moreFieldsE[0][date_naissance]" class="form-control"  placeholder="Enter date naissance"/></td>
            <td><input style="width: 300px"  type="file" name="moreFieldsE[0][e_image]" class="form-control" value="{{ old('e_image') }}"/></td>
            <td><button type="button" name="add" id="add-btnE" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
    </tr>
  </table>
</div>
</div>
  <button type="submit" class="btn btn-success">Enregistrer</button>
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

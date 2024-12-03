
@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
<div class="card mt-3">
  @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3' || $user_logged_in->profile == 'profil1')

  <div class="card-header text-primary"><h2>Ajouter/Affaire</h2></div>
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
<p class="text-primary">AFFAIRE:</p>
  <div class="table-responsive">
  <table class="table table-bordered table-responsive" id="" style="width: 100%">
    <tr>
      <th>N°affaire</th>
      <th>Type d'affaire</th>
      <th>Date</th>
      <th>Service demandeur</th>
      <th>Référence</th>
      <th>N°affaire dans le commissariat</th>
      <th>Lieu d'infraction</th>
	   <th> Date et periode d'intervention</th>
		     <th>N°Soit transmis</th>
			   <th>N°Rapport</th>
			      <th>Victime</th>
    </tr>
    <tr>
  <div class="form-group">
    
         <td>  <input style="width: 160px" maxlength="8" required="required" type="text" id="num_affaire" name="num_affaire" placeholder="Entrer num_affaire" class="form-control" value="{{ old('num_affaire') }}" onkeypress="return isNumberKey(event)" />   </td>
 
      <td><input style="width: 220px" required="required" type="text" name="type" placeholder="Entrer type d'affaire" class="form-control" value="{{ old('type') }}"/></td>
      <td><input style="width: 150px" required="required"  type="date" name="date" class="form-control" /></td>
      <td>
        <select id="emp"  required="required" style="width: 280px" name="employe" class="form-control selectemp" id="">
            @forelse ($c as $employe)
            <option {{ old('employe') == $employe->id ? 'selected' : '' }}  value="{{$employe->id}}">{{$employe->nom." DRS ".$employe->region}}</option>
            @empty
            @endforelse
        </select> </td>
        <td><input style="width: 250px" required="required"  type="txt" name="reference" placeholder="Entrer la reference"class="form-control" value="{{ old('reference') }}"/></td>

      <td><input style="width: 150px"   type="txt" name="num_affaire_c" placeholder="Entrer num_affaire_commissariat" class="form-control" /></td>


      <td><input style="width: 300px"  type="txt" name="lieu_crime" placeholder="Entrer lieu d'infraction"class="form-control" /></td>
     <td><input style="width: 280px"  type="txt" name="periode" placeholder="Entrer date et periode d'intervention"class="form-control" /></td>
  
	        <td><input style="width: 125px"   type="txt" name="num_soit" placeholder="Entrer num_soit" class="form-control" /></td>
			  <td><input style="width: 125px"   type="txt" name="num_rapport" placeholder="Entrer num_rapport" class="form-control" /></td>
			  	  <td><input style="width: 200px"   type="txt" name="victim" placeholder="nom et prénom" class="form-control" /></td>
    </table>
  </div>



<p class="text-primary">INTERVENANT(S) SUR LA SCENE DE CRIME</p>
<div class="table-responsive">
  <table class="table table-bordered" id="dynamicAddRemoveC">
    <tr>

      <th>nom</th>
      <th>prenom</th>
      <th>matricule</th>
      <th>grade</th>
      <th>date d'intervention</th>
      <th>photo</th>
      <th>action</th>
    </tr>
    <tr>
      <td><input style="width: 160px" required="required" type="text" name="moreFieldsC[0][nom]" placeholder="Entrer nom" class="form-control" value="{{old('moreFieldsC[0][nom]')}}"/></td>
      <td><input style="width: 160px" required="required" type="text" name="moreFieldsC[0][prenom]" placeholder="Entrer prénom" class="form-control" value="{{ old('moreFieldsC[0][prenom]') }}"/></td>
      <td><input style="width: 160px" required="required" type="text" name="moreFieldsC[0][matricule]" placeholder="Entrer matricule" class="form-control" value="{{ old('moreFieldsC[0][matricule]') }}"/></td>
      <td><input style="width: 160px" required="required" type="text" name="moreFieldsC[0][grade]" placeholder="Entrer grade" class="form-control" value="{{ old('moreFieldsC[0][grade]') }}"/></td>
   
      <td><input style="width: 180px" required="required"  type="date" name="moreFieldsC[0][date_intervention]" class="form-control" /></td>
      <td><input style="width: 300px" required="required" type="file" name="moreFieldsC[0][e_image]" class="form-control" value=""/></td>
      <td><button type="button" name="add" id="add-btnC" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
    </tr>
</table>
</div>

<div>associer des Echantillons </div>
<label for="chkYes">
    <input type="radio" id="chkYes" name="genre" value="1"/> Oui
  </label>
  <label for="chkNo">
    <input checked type="radio" id="chkNo" name="genre" value="0"/> Non
  </label>
  <hr>
  <div id="dvPinNo" style="display: none">
  <p class="text-primary">Echantillons</p>
  <div class="table-responsive">
    <table class="table table-bordered" id="dynamicAddRemoveE">
      <tr>

        <th>N°echantillon</th>
        <th>N°Scellé</th>
		<th>Déscription</th>
		<th>Etat</th>
        <th>Periode_conservation</th>
        <th> Action</th>

      </tr>
      <tr>

	          <td><input style="width: 150px"  type="text" name="moreFieldsE[0][num_echantillon]" placeholder="Entrer N°echantillon" class="form-control" value=""/></td>
	          <td><input style="width: 150px"  type="text" name="moreFieldsE[0][num_scelle]" placeholder="Entrer N°Scellé" class="form-control" value=""/></td>
        <td><input style="width: 230px"  type="text" name="moreFieldsE[0][description]" placeholder="Entrer Déscription" class="form-control" value=""/></td>
        <td><select style="width: 165px"  name="moreFieldsE[0][etat]" id="" class="form-control"><option value="Conforme">conforme</option><option value="NonConforme" >NonConforme</option></select></td>
        <td><input style="width:  230px"  type="text" name="moreFieldsE[0][periode_conservation]"  placeholder="Entrer periode conservation" class="form-control" value=""/></td>
        <td><button type="button" name="add" id="add-btnE" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
    </tr>
</table>
</div>
</div>
<p></p>
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
<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
@endsection


@extends('layout')
@section('content')
<div class="container">
<div class="card mt-3">
<div class="card-header"><h2>Modifier une livret familliale</h2></div>
<div class="card-body">
<form action="{{ route('employes.update', ['employe'=>$employe->id]) }}" method="POST" enctype="multipart/form-data">
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
@if (Session::has('success'))
<div class="alert alert-success text-center">
<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
<p>{{ Session::get('success') }}</p>
</div>
@endif
<p>Employé:  nombre couple : {{ $employe->couples_count }}   nombre enfants : {{ $employe->enfants_count }}</p>

<table class="table table-bordered" id="">
<tr>
<th>matricule</th>
<th>nni</th>
<th>nom</th>
<th>prenom</th>
<th>statut</th>
<th>sexe</th>
<th>photo</th>
</tr>
<tr>
    <td><input required="required" type="text" name="matricule" placeholder="Enter matricule" class="form-control" value="{{ old('matricule', $employe->matricule ?? null) }}"/></td>
    <td><input required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni', $employe->nni ?? null) }}"/></td>
    <td><input required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom', $employe->nom ?? null) }}"/></td>
    <td><input required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom', $employe->prenom ?? null) }}"/></td>
    <td><select required="required" name="statut" id="" class="form-control"><option {{ $employe->statut ? 'selected' : '' }} value="1"  >active</option><option value="0" {{ !$employe->statut ? 'selected' : '' }} >non active</option></select></td>
    <td><select required="required" name="sexe" id="" class="form-control"><option {{ $employe->sexe == 'masculin' ? 'selected' : '' }}  value="masculin">masculin</option><option {{ $employe->sexe == 'feminin'  ? 'selected' : '' }} value="feminin">féminin</option></select></td>
    <td><input  type="file" name="emp_image" class="form-control" value="{{ old('emp_image') }}"/></td>
</tr>
</table>
<p>couple</p>
<table class="table table-bordered" id="dynamicAddRemoveC">
<tr>
  <th>nni</th>
  <th>nom</th>
  <th>prenom</th>
  <th>statut</th>
  <th>sexe</th>
  <th>action</th>
</tr>
@if ($employe->couples_count == 0)
<tr>
  <input type="hidden" name="count_c" value="0">
  <td><input maxlength="10" required="required" type="text" name="moreFieldsC[0][nni]" placeholder="Enter nni" class="form-control" value="{{old('moreFieldsC[0][nni]')}}"/></td>
  <td><input required="required" type="text" name="moreFieldsC[0][nom]" placeholder="Enter nom" class="form-control" value="{{old('moreFieldsC[0][nom]')}}"/></td>
  <td><input required="required" type="text" name="moreFieldsC[0][prenom]" placeholder="Enter prénom" class="form-control" value="{{ old('moreFieldsC[0][prenom]') }}"/></td>
  <td><select required="required" name="moreFieldsC[0][statut]" id="" class="form-control"><option value="1">active</option><option value="0">non active</option></select></td>
  <td><select required="required" name="moreFieldsC[0][sexe]" id="" class="form-control"><option {{ old('moreFieldsC[0][sexe]') == 'masculin' ? 'selected' : '' }} value="masculin">masculin</option><option {{ old('moreFieldsC[0][sexe]') == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select></td>
  <td><input required="required" type="file" name="moreFieldsC[0][couple_image]" class="form-control" value=""/></td>
  <td><button type="button" name="add" id="add-btnC" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
</tr>
@elseif($employe->couples_count == 2)
  @php ($i = -1)
  @forelse ($employe->couples as $couple)
  @php (++$i)
  <tr>
    <input type="hidden" name="count_c" value="moreFieldsC[{{$couple->id}}][id]">
    <td><input required="required" type="text" name="moreFieldsC[{{$i}}][nni]" placeholder="Enter nni" class="form-control" value="{{ $couple->nni }}"/></td>
    <td><input required="required" type="text" name="moreFieldsC[{{$i}}][nom]" placeholder="Enter nom" class="form-control" value="{{ $couple->nom }}"/></td>
    <td><input required="required" type="text" name="moreFieldsC[{{$i}}][prenom]" placeholder="Enter prénom" class="form-control" value="{{ $couple->prenom }}"/></td>
    <td><select required="required" name="moreFieldsC[{{$i}}][statut]" id="" class="form-control"><option {{ $couple->statut ? 'selected' : '' }} value="1">active</option><option {{ !$couple->statut ? 'selected' : '' }} value="0">non active</option></select></td>
    <td><select required="required" name="moreFieldsC[0][sexe]" id="" class="form-control"><option {{ $couple->sexe == 'masculin' ? 'selected' : '' }} value="masculin">masculin</option><option {{ $couple->sexe == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select></td>
    <td><input required="required" type="file" name="moreFieldsC[{{$i}}][couple_image]" class="form-control" value=""/></td>
    @if ($loop->first)
    <td><button type="button" name="add" id="add-btnC" class="btn btn-success " disabled><i class="fas fa-plus-circle"></i></button></td>
    @else 
    {{-- <td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td> --}}
    @endif
  </tr>  
  @empty
  
  @endforelse
@else
<tr>
  <td><input required="required" type="text" name="moreFieldsC[0][nni]" placeholder="Enter nni" class="form-control" value="{{ $employe->couples[0]->nni }}"/></td>
  <td><input required="required" type="text" name="moreFieldsC[0][nom]" placeholder="Enter nom" class="form-control" value="{{ $employe->couples[0]->nom }}"/></td>
  <td><input required="required" type="text" name="moreFieldsC[0][prenom]" placeholder="Enter prénom" class="form-control" value="{{ $employe->couples[0]->prenom }}"/></td>
  <td><select required="required" name="moreFieldsC[0][statut]" id="" class="form-control"><option {{ $employe->couples[0]->statut ? 'selected' : '' }} value="1">active</option><option {{ !$employe->couples[0]->statut ? 'selected' : '' }} value="0">non active</option></select></td>
  <td><select required="required" name="moreFieldsC[0][sexe]" id="" class="form-control"><option {{ $employe->couples[0]->sexe == 'masculin' ? 'selected' : '' }} value="masculin">masculin</option><option {{ $employe->couples[0]->sexe == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select></td>
  <td><input required="required" type="file" name="moreFieldsC[0][couple_image]" class="form-control" value=""/></td>
  <td><button type="button" name="add" id="add-btnC" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
</tr>
@endif
</table>
@if ($employe->enfants_count == 0)
<div>a enfant(s)?</div>
<label for="chkYes">
  <input type="radio" id="chkYes" name="genre" value="1"/> Oui
</label>
<label for="chkNo">
  <input type="radio" id="chkNo" name="genre" value="0"/> Non
</label>
<hr>
<div id="dvPinNo" style="display: none">
    <p>Enfants</p>
<table class="table table-bordered" id="dynamicAddRemoveE">
<tr>
<th>nni</th>
<th>nom</th>
<th>prenom</th>
<th>statut</th>
<th>sexe</th>
<th>action</th>
</tr>
<tr>
    <input type="hidden" name="count_e" value="0">
    <td><input type="text" name="moreFieldsE[0][nni]" placeholder="Enter nni" class="form-control" /></td>
    <td><input type="text" name="moreFieldsE[0][nom]" placeholder="Enter nom" class="form-control" /></td>
    <td><input type="text" name="moreFieldsE[0][prenom]" placeholder="Enter prénom" class="form-control" /></td>
    <td><select name="moreFieldsE[0][statut]" id="" class="form-control"><option value="1">active</option><option value="0">non active</option></select></td>
    <td><select name="moreFieldsE[0][sexe]" id="" class="form-control"><option value="active">masculin</option><option value="active">féminin</option></select></td>
    <td><button type="button" name="add" id="add-btnE" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
</tr>
</table>
@else
  <p>Enfants</p>
  <table class="table table-bordered" id="dynamicAddRemoveE">
  <tr>
  <th>nni</th>
  <th>nom</th>
  <th>prenom</th>
  <th>statut</th>
  <th>sexe</th>
  <th>action</th>
  </tr>
  @forelse ($employe->enfants as $enfant)
    <tr>
      <td><input type="text" name="moreFieldsE[0][nni]" placeholder="Enter nni" class="form-control" value="{{ $enfant->nni }}"/></td>
      <td><input type="text" name="moreFieldsE[0][nom]" placeholder="Enter nom" class="form-control" value="{{ $enfant->nom }}"/></td>
      <td><input type="text" name="moreFieldsE[0][prenom]" placeholder="Enter prénom" class="form-control" value="{{ $enfant->prenom }}"/></td>
      <td><select name="moreFieldsE[0][statut]" id="" class="form-control"><option {{ $enfant->statut ? 'selected' : '' }} value="1">active</option><option {{ !$enfant->statut ? 'selected' : '' }} value="0">non active</option></select></td>
      <td><select name="moreFieldsE[0][sexe]" id="" class="form-control"><option {{ $enfant->sexe == 'masculin' ? 'selected' : '' }} value="masculin">masculin</option><option {{ $enfant->sexe == 'feminin' ? 'selected' : '' }} value="feminin">féminin</option></select></td>
      @if ($loop->last)
      <td><button type="button" name="add" id="add-btnE" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
      {{-- <td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td> --}}
      @else 
      @endif
    </tr>
  @empty
      
  @endforelse
  </table>
@endif
<button type="submit" class="btn btn-success">Modifier</button>
</div>



</form>
</div>
</div>
</div>
<script type="text/javascript">
var i = 0;
$("#add-btnC").click(function(){
++i;
$("#dynamicAddRemoveC").append('<tr><td><input type="text" name="moreFieldsC['+i+'][nni]" placeholder="Enter nni" class="form-control" /></td><td><input type="text" name="moreFieldsC['+i+'][nom]" placeholder="Enter nom" class="form-control" /></td><td><input type="text" name="moreFieldsC['+i+'][prenom]" placeholder="Enter prénom" class="form-control" /></td><td><select  name="moreFieldsC['+i+'][statut]"  class="form-control"><option value="1">active</option><option value="0">non active</option></select></td><td><select name="moreFieldsC['+i+'][sexe]" class="form-control"><option value="masulin">masculin</option><option value="feminin">féminin</option></select></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){
$(this).parents('tr').remove();
});

var j = 0;
$("#add-btnE").click(function(){
++i;
$("#dynamicAddRemoveE").append('<tr><td><input required="required" type="text" name="moreFieldsE['+j+'][nni]" placeholder="Enter nni" class="form-control" /></td><td><input required="required" type="text" name="moreFieldsE['+j+'][nom]" placeholder="Enter nom" class="form-control" /></td><td><input required="required" type="text" name="moreFieldsE['+j+'][prenom]" placeholder="Enter prénom" class="form-control" /></td><td><select required="required"  name="moreFieldsE['+j+'][statut]"  class="form-control"><option value="1">active</option><option value="0">non active</option></select></td><td><select required="required" name="moreFieldsE['+j+'][sexe]" class="form-control"><option vlaue="maculin">masculin</option><option vlaue="feminin">féminin</option></select></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){
$(this).parents('tr').remove();
});

$(function() {
   $("input[name='genre']").click(function() {
     if ($("#chkYes").is(":checked")) {
       $("#dvPinNo").show();
     } else {
       $("#dvPinNo").hide();
     }
   });
 });
</script>
@endsection

@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil1' ||$user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')




  <div class="card-header text-primary"><h2>Ajouter/Affaire</h2></div>
  <div class="card-body">
            <form action="{{ route('empone.store') }}" method="POST" enctype="multipart/form-data">
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

                <div class="table-responsive">
                <table class="table table-bordered table-responsive" id="" style="width: 100%">
                  <tr>
                    <th>N°affaire</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Partie declarent</th>
                    <th>Référence</th>
                    <th>N°affaire dans le commissariat</th>
					    <th>Lieu de prélevement</th>
		  <th>Date de prélevement</th>
		      <th>N°Soit transmis</th>
			   <th>N°Rapport</th>
			   	   <th>Victime</th>
                  </tr>
                  <tr>
                    <td><input style="width: 160px" maxlength="8" required="required" type="text" name="num_affaire" placeholder="Entrer num_affaire" class="form-control" value="{{ old('num_affaire') }}"/></td>
                    <td><input style="width: 125px" required="required" type="text" name="type" placeholder="Entrer type d'affaire" class="form-control" value="{{ old('type') }}"/></td>
                    <td><input style="width: 150px" required="required"  type="date" name="date" class="form-control" /></td>
                    <td>
                      <select id="emp"  required="required" style="width: 180px" name="employe" class="form-control selectemp" id="">
                          @forelse ($c as $employe)
                          <option {{ old('employe') == $employe->id ? 'selected' : '' }}  value="{{$employe->id}}">{{$employe->nom." DRS ".$employe->region}}</option>
                          @empty
                          @endforelse
                      </select> </td>
                      <td><input style="width: 150px" required="required"  type="txt" name="reference" placeholder="Entrer reference"class="form-control" value="{{ old('reference') }}"/></td>
                    <td><input style="width: 150px"   type="txt" name="num_affaire_c" placeholder="Entrer num_affaire_commissariat" class="form-control" /></td>
					 <td><input style="width: 150px"   type="txt" name="lieu_prelevement" placeholder="Entrer lieu prelevement"class="form-control" /></td>
					<td><input style="width: 150px"  type="date" name="date_prelevement" placeholder="Entrer date de prelevement"class="form-control" /></td>
	            <td><input style="width: 150px"   type="txt" name="num_soit" placeholder="Entrer num_soit" class="form-control" /></td>
				 <td><input style="width: 125px"   type="txt" name="num_rapport" placeholder="Entrer num_rapport" class="form-control" /></td>
				 	 <td><input style="width: 125px"   type="txt" name="victim" placeholder="Entrer Nom-Prénom" class="form-control" /></td>
                </tr>
            </table>
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

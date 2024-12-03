@extends('layout')
@section('content')
@php
$user_id = auth()->user()->id;
$user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <div class="card">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil1')
        <div class="card-header text-primary"><h2>Ajouter/Echantillon </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('echantillons.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="m">N°echantillon</label>
                        <input id="m" maxlength="12" required="required" type="text" name="num_echantillon" placeholder="Entrer num_echantillon" class="form-control" ) }}"/>
                      </div>
					  <div class="form-group">
                        <label for="m">N°Scellé</label>
                        <input id="m" maxlength="12" type="text" name="num_scelle" placeholder="Entrer num_echantillon" class="form-control" ) }}"/>
                      </div>
					      <div class="form-group">
                            <label for="emp">N°Affaire</label>
                            <select id="emp"  required="required" name="employe" class="form-control selectemp" id="">
                                <option disabled selected value="vide">choisir le numero d'affaire</option>
                                @forelse ($affaires as $employe)
                                <option {{ old('employe') == $employe->id ? 'selected' : '' }}  value="{{$employe->id}}">{{$employe->num_affaire}}</option>
                                @empty
                                @endforelse
                            </select>
                          </div>

                        <div class="form-group">
                          <label for="description">Déscription</label>
                          <input id="description"  required="required" type="text" name="description" placeholder="Entrer description" class="form-control" value="{{ old('description') }}"/>
                        </div>
							 <div class="form-group">
										<label for="etat">Etat</label>
										<select id="etat" name="etat" class="form-control selectemp">
											<option value="conforme">Conforme</option>
											<option value="nonconforme">Non Conforme</option>
										</select>
										</div>
                     
                       <div class="form-group">
                            <label for="dn">Date du  prélèvement</label>
                            <input id="dn"  type="date" name="datep" class="form-control"  }}"/>
                          </div>
                        <div class="form-group">
                            <label for="d">Periode de conservation</label>
                          <input id="periode_conservation" type="text" name="periode_conservation" placeholder="Entrer periode_conservation" class="form-control" }}"/>
                        </div>
						<div class="form-group">
							<label for="traite">Traité</label>
							<select id="traite" name="traite" class="form-control selectemp">
								<option value="Oui">Oui</option>
								<option value="Non">Non </option>
							</select>
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

@endsection

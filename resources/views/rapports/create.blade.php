@extends('layout')
@section('content')
@php
$user_id = auth()->user()->id;
$user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <div class="card">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil1')
        <div class="card-header text-primary"><h2>Ajouter/Document(s) </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('rapports.store') }}" method="POST" enctype="multipart/form-data">
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
			     @if (Session::has('denied'))
                        <div class="alert alert-danger text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('denied') }}</p>
                        </div>
                        @endif
                <div class="table-responsive">
                    <div class="form-group">
                        <label for="emp">N°Affaire</label>
                        <select id="emp"  required="required" name="affaire" class="form-control selectemp" id="">
                            <option disabled selected value="vide">choisir le numero d'affaire</option>
                            @forelse ($affaires as $employe)
                            <option {{ old('affaire') == $employe->id ? 'selected' : '' }}  value="{{$employe->id}}">{{$employe->num_affaire}}</option>
                            @empty
                            @endforelse
                        </select>
                      </div>



                        @if ( $user_logged_in->profile == 'profil1'||$user_logged_in->profile == 'profil3')

                        <div class="form-group">
                            <label for="section">Fiche de préparation </label>
                            <input id="s"  type="file" name="section" class="form-control" value="{{ old('section') }}"/>
                          </div>

                          <div class="form-group">
                            <label for="methode_analyse">Fiche d'extraction</label>
                            <input id="m"  type="file" name="methode_analyse" class="form-control" value="{{ old('methode_analyse') }}"/>
                          </div>
                          <div class="form-group">
                            <label for="f_Q">Fiche de quantification</label>
                            <input id="l"  type="file" name="f_Q" class="form-control" value="{{ old('f_Q') }}"/>
                          </div>
                        <div class="form-group">
                          <label for="echantillons">Fiche PCR</label>
                          <input id="echantillons" type="file" name="echantillons" class="form-control" value="{{ old('echantillons') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="ons">Fiche Genotypage</label>
                            <input id="ons" type="file" name="f_genotypage" class="form-control" value="{{ old('f_genotypage') }}"/>
                          </div>
                          <div class="form-group">
                            <label for="photo">Rapport Bio</label>
                            <input id="photo"  type="file" name="pdf" class="form-control" value="{{ old('pdf') }}"/>
                          </div>

                          <div class="form-group">
                            <label for="conclusion">Décharge Bio</label>
                            <input id="conclusion"  type="file" name="conclusion"  class="form-control" value="{{ old('conclusion') }}"/>
                          </div>


                          @endif
                          @if ( $user_logged_in->profile == 'profil2'||$user_logged_in->profile == 'profil3')
                          <div class="form-group">
                            <label for="photo">Fiche réception et vérification de la conformité du scellé</label>
                            <input id="photo"  type="file" name="f_v_scelle" class="form-control" value="{{ old('f_v_scelle') }}"/>
                          </div>


                          <div class="form-group">
                            <label for="photo">Fiche prepartion des  échantillons</label>
                            <input id="photo"  type="file" name="f_p" class="form-control" value="{{ old('f_p')  }}"/></div>



                            <div class="form-group">
                              <label for="photo">Fiche analyse et vérification des résultats</label>
                              <input id="photo"  type="file" name="f_v_a_resultat" class="form-control" value="{{ old('f_v_a_resultat')  }}"/></div>
                              <div class="form-group">
                                <label for="photo">Rapport chimie </label>
                                <input id="photo"  type="file" name="p" class="form-control" value="{{ old('p') }}"/>
                              </div>

                              <div class="form-group">
                                <label for="c">Décharge chimie</label>
                                <input id="c"  type="file" name="c"  class="form-control" value="{{ old('c') }}"/>
                              </div>


                          @endif
						       @if ($user_logged_in->profile == 'profil3')
								   <div class="form-group">
                            <label for="conclusion">Rapport Technique</label>
                            <input id="d"  type="file" name="d"  class="form-control" value="{{ old('d') }}"/>
                          </div>
						  	   <div class="form-group">
                            <label for="conclusin">Rapport Medecin Légiste</label>
                            <input id="conclusin"  type="file" name="rapport_medecin_legiste"  class="form-control" value="{{ old('rapport_medecin_legiste') }}"/>
                          </div>
						   	   <div class="form-group">
                            <label for="conclusi">Rapport Empreinte Digitale</label>
                            <input id="conclusi"  type="file" name="rapport_emp"  class="form-control" value="{{ old('rapport_emp') }}"/>
                          </div>
						   	   <div class="form-group">
                            <label for="conclus">Rapport Balistique</label>
                            <input id="conclus"  type="file" name="rapport_balistique"  class="form-control" value="{{ old('rapport_balistique') }}"/>
                          </div>



                          <div class="form-group">
                            <label for="concls">Ordre judiciaire</label>
                            <input id="concls"  type="file" name="ordre_judiciaire"  class="form-control" value="{{ old('ordre_judiciaire') }}"/>
                          </div>






    @endif
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

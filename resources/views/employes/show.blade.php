@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp




<ul class="font-weight-bold">
    @if (Session::has('success'))
        <div class="container alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    @if (Session::has('denied'))
        <div class="container alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('denied') }}</p>
        </div>
    @endif





    <ul class="font-weight-bold">
        <li class="border border-primary p-4">
            <ul><span class="font-weight-bold text-primary">Affaire N°: </span>{{ $employe->num_affaire }}

                <li><span class="font-weight-bold text-primary">Type :</span> {{ $employe->type }}</li>
                <li><span class="font-weight-bold text-primary">Date de réception : </span>{{ $employe->date}} </li>
                <li><span class="font-weight-bold text-primary">Partie declarent: </span>{{ $employe->partie_declarent }}</li>
				   <li><span class="font-weight-bold text-primary">Référence : </span>{{ $employe->reference }}</li>
                    <li><span class="font-weight-bold text-primary">N°affaire_commissariat : </span>{{ $employe->num_affaire_c }}</li>
					      <li><span class="font-weight-bold text-primary">Lieu d'infraction:</span> {{ $employe->lieu_crime}}</li>
                <li><span class="font-weight-bold text-primary">Date et periode d'intervention:</span> {{ $employe->periode}}</li>
      <li><span class="font-weight-bold text-primary">Lieu et date de Prélevement  :</span> {{ $employe->lieu_prelevement.' '. $employe->date_prelevement}}</li>
				        <li><span class="font-weight-bold text-primary">N° Rapport(s) :</span> {{ $employe->num_rapport }}</li>
						      <li><span class="font-weight-bold text-primary">N°soit(s) transmis :</span> {{ $employe->num_soit }}</li>
							       <li><span class="font-weight-bold text-primary">Victime :</span> {{ $employe->victim }}</li>
				 <p>
							                  <p class="card-text text-success font-weight-bold">  @if ($employe->resultat == '1')
                    <i class="fas fa-check"></i> Résultat Positive
                    @endif
                </p>
			
				  </p>
				       @if ( $user_logged_in->profile == 'profil3' )
				
     <div class="text-right mb-3">
    <a class="btn btn-success btn-sm" type="button" href="{{ route('employes.edit', ['employe' => $employe->id]) }}">
        <i class="fas fa-edit"></i>
    </a>
    <form method="POST" action="{{ route('employes.destroy', ['employe' => $employe->id]) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette affaire ??')" class="btn btn-danger btn-sm" type="submit">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</div>

	    @endif		
            @if ($employe->intervenants->count() > 0)

            <li class="border border-success mt-4 p-4">
                <ul><span class="font-weight-bold text-primary">INTERVENANT(S) SUR LA SCENE DE CRIME</span>
                    <li>
                        <table class="table  table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th><span class="text-primary">photo</span> </th>
                                    <th><span class="text-primary">matricule</span> </th>
                                    <th><span class="text-primary">nom & prénom</span> </th>
                                    <th><span class="text-primary">grade</span> </th>
									<th><span class="text-primary">date_intervention</span> </th>
                                	<th><span class="text-primary">Action </span> </th>
            </li>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employe->intervenants as $couple)
                                        <tr>
                                            <td>
                                                @if ($couple->image == null)
                                                    <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                                                @else
                                                    <img src="{{ asset('/couple_images/'.$couple->matricule.'.jpg') }}" width="100px" height="100px">
                                                @endif                                            </td>
                                            <td>{{ $couple->matricule}}</td>

                                            <td>{{ $couple->nom .' '. $couple->prenom}}</td>
                                            <td>{{ $couple->grade}}</td>
											        <td>{{ $couple->date_intervention}}</td>
											       @if ( $user_logged_in->profile == 'profil3' )
                                 
											 <td>   <form method="POST" action="{{ route('intervenants.destroy', ['intervenant' => $couple->id]) }}">
														@csrf
														@method('DELETE')
														<button onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet Intervenant ?')" class="btn btn-danger btn-sm" type="submit">
															<i class="fas fa-trash-alt"></i>
														</button>
													</form>
											</td>
											        @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </li>
                </ul>
            </li>
        @else
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Pas des intervenants!</strong>
            </div>

            <script>
              $(".alert").alert();
            </script>
        @endif
		
		
		
		
		
	 @if ($employe->echantillons->count() > 0)

            <li class="border border-success mt-4 p-4">
                <ul><span class="font-weight-bold text-primary">Les Échantillons Prélevés sur la Scène de Crime</span>
                    <li>
                        <table class="table  table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                 <th data-sortable="true">N°échantillon</th>
							 <th   data-sortable="true">N°Scellé</th>
							     <th  data-sortable="true">Déscription</th>
							     <th   data-sortable="true">Etat</th>
								 <th   data-sortable="true">Traité</th>
								  <th   data-sortable="true">Action</th>
            </li>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employe->echantillons as $e)
                                        <tr>
                                        <td>{{$e->num_echantillon  }}</td>
								     <td>{{$e->num_scelle  }}</td>
                          
                                    <td> {{$e->description}}</td>
                                    <td>{{ $e->etat }}</td>
									<td>{{$e->traite}}</td>
										<td>
										   <a href="{{ route('echantillons.edit', $e->id) }}" class="btn btn-primary btn-sm">
                                    Modifier
                                </a>
										</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </li>
                </ul>
            </li>
        @else
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Pas des échantillons!</strong>
            </div>

            <script>
              $(".alert").alert();
            </script>
        @endif
	
		
		
        @if ($employe->rapports->count() > 0)

        <li class="border border-success mt-4 p-4">
            <ul><span class="font-weight-bold text-primary">DOCUMENT(S) ASSOSSIE(S)</span>
                <li>  @if ( $user_logged_in->profile == 'profil1')

                    <table class="table  table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Rapport</th>
                                <th>Decharge</th>
                                <th>F.Préparat°</th>
                                <th>F.Extract°</th>
                                <th>F.PCR</th>
                                <th>F.Genotypage</th>


                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employe->rapports as $enfant)
                                    <tr>
										<td><a href ="{{asset('/files/'.$enfant->pdf) }}">{{$enfant->pdf}}</a>  </td>
                                        <td><a href ="{{asset('/files/'.$enfant->conclusion) }}">{{$enfant->conclusion}}</a>  </td>
                                        <td><a href ="{{asset('/files/'.$enfant->section) }}">{{$enfant->section}}</a></td>
                                        <td><a href ="{{asset('/files/'.$enfant->methode_analyse) }}">{{$enfant->methode_analyse}}</a> </td>
                                        <td><a href ="{{asset('/files/'.$enfant->echantillons) }}">{{$enfant->echantillons}}</a> </td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_genotypage) }}">{{$enfant->f_genotypage}}</a>  </td>



                                     </tr>
                                @endforeach
                            </tbody>
                    </table>@endif


                    @if ( $user_logged_in->profile == 'profil2' )

                    <table class="table  table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
								<th>Rapport</th>
                                <th>Decharge</th>
                                <th>F.Vérification_scellé</th>
                                <th>F.Préparation</th>
                                <th>F.Analyse_résultats</th>



                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($employe->rapports as $enfant)
                                    <tr>
									    <td><a href ="{{asset('/files/'.$enfant->p) }}">{{$enfant->p}}</a>  </td>
                                        <td><a href ="{{asset('/files/'.$enfant->c) }}">{{$enfant->c}}</a>  </td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_v_scelle) }}">{{$enfant->f_v_scelle}}</a></td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_p) }}">{{$enfant->f_p}}</a> </td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_v_a_resultat) }}">{{$enfant->f_v_a_resultat}}</a>  </td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>@endif
                        @if ( $user_logged_in->profile == 'profil3' )

                        <table class="table  table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>

                                    <th>Rapport Bio</th>
                                    <th>Decharge R.Bio</th>
                                    <th>Rapport chimie</th>
                                    <th>Decharge R.chimie</th>
   @if (( $user_logged_in->name == 'dev')||( $user_logged_in->name == 'Ahmedou'))
                                    <th>Rapport technique</th>

                                       <th>Rapport Medecin légiste</th>
							  <th>Rapport Empreinte digitale</th>
							    <th>Rapport Balistique</th>
                                <th>Requsition</th>
  @endif					   </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employe->rapports as $enfant)
                                        <tr>   <td><a href ="{{asset('/files/'.$enfant->pdf) }}">{{$enfant->pdf}}</a>  </td>
                                            <td><a href ="{{asset('/files/'.$enfant->conclusion) }}">{{$enfant->conclusion}}</a>  </td>

                                            <td><a href ="{{asset('/files/'.$enfant->p) }}">{{$enfant->p}}</a>  </td>
                                            <td><a href ="{{asset('/files/'.$enfant->c) }}">{{$enfant->c}}</a>  </td>

											  	   @if (( $user_logged_in->name == 'dev')||( $user_logged_in->name == 'Ahmedou'))
													        <td><a href ="{{asset('/files/'.$enfant->d) }}">{{$enfant->d}}</a>  </td>
                                        <td><a href ="{{asset('/files/'.$enfant->rapport_medecin_legiste) }}">{{$enfant->rapport_medecin_legiste}}</a>  </td>
									       <td><a href ="{{asset('/files/'.$enfant->rapport_emp) }}">{{$enfant->rapport_emp}}</a>  </td>
										          <td><a href ="{{asset('/files/'.$enfant->rapport_balistique) }}">{{$enfant->rapport_balistique}}</a>  </td>
                                                  <td><a href ="{{asset('/files/'.$enfant->ordre_judiciaire) }}">{{$enfant->ordre_judiciaire}}</a>  </td>
                                                  @endif




                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>@endif

                </li>
            </ul>
        </li>
    @else
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <strong>Pas de Document!</strong>
        </div>   <script>
            $(".alert").alert();
        </script>
    @endif








@if ($employe->reserves->count() > 0)

<li class="border border-success mt-4 p-4">
    <ul><span class="font-weight-bold text-primary">RESTE DU SCELLE</span>
        <li>
            <table class="table  table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>caracteristiques</th>
                        <th>Etat</th>
                        <th>Periode_conservation</th>


                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($employe->reserves as $c)
                            <tr>

                                <td>{{ $c->caracteristiques}}</td>
                                <td>{{ $c->etat}}</td>
                                <td>{{ $c->periode_conservation}}</td>


                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </li>
    </ul>
</li>
@else
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Pas de reste du scellé!</strong>
</div>

<script>
  $(".alert").alert();
</script>
@endif









    </ul>
@endsection

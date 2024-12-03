@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
        <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
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
                <h4 class="card-title">Liste des documents</h4>
                <p class="card-text text-success font-weight-bold">Total : {{ $count_enfants }}</p>
                {{ $enfants->links() }}
                <table
                    class="table"
                    data-toggle="table"
                    data-pagination="false"
                    data-search="true"
                    data-locale="fr-FR"

                        >  @if ( $user_logged_in->profile == 'profil2')
                        <thead class="thead-inverse">
                            <tr>
                                <th>N°Affaire</th>
								      <th>Rapport</th>
                                <th>Soit transmit</th>
                                <th>F.Vérificat°_scellé</th>
                                <th>F.Préparat°</th>
                                <th>F.Analyse_résultats</th>
                          
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enfants as $enfant)
                                <tr>
                                    <td>{{ $enfant->num_affaire}}</td>
									                                        <td><a href ="{{asset('/files/'.$enfant->p) }}">{{$enfant->p}}</a>  </td>
                                        <td><a href ="{{asset('/files/'.$enfant->c) }}">{{$enfant->c}}</a>  </td>
                                    <td><a href ="{{asset('/files/'.$enfant->f_v_scelle) }}">{{$enfant->f_v_scelle}}</a></td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_p) }}">{{$enfant->f_p}}</a> </td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_v_a_resultat) }}">{{$enfant->f_v_a_resultat}}</a>  </td>

                                   

                                        <td>
                                            <a class="btn btn-success btn-sm" type="button" href="{{ route('enfants.edit', ['enfant' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>

                                        </td>

                                </tr>
                            @empty
                                <tr>
                                    <td>Pas de Document!</td>
                                </tr>
                            @endforelse
                        </tbody>@endif
                        @if ( $user_logged_in->profile == 'profil1')
                        <thead class="thead-inverse">
                            <tr>
                                <th>N°Affaire</th>
								      <th>Rapport</th>
                                <th>Soit transmit</th>
                                <th>F.Préparat°</th>
                                <th>F.Extract°</th>
                                <th>F.PCR</th>
                                <th>F.Genotypage</th>
                          
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enfants as $enfant)
                                <tr>
                                    <td>{{ $enfant->num_affaire}}</td>
									    <td><a href ="{{asset('/files/'.$enfant->pdf) }}">{{$enfant->pdf}}</a>  </td>
                                    <td><a href ="{{asset('/files/'.$enfant->conclusion) }}">{{$enfant->conclusion}}</a>  </td>
                                    <td><a href ="{{asset('/files/'.$enfant->section) }}">{{$enfant->section}}</a></td>
                                    <td><a href ="{{asset('/files/'.$enfant->methode_analyse) }}">{{$enfant->methode_analyse}}</a> </td>
                                    <td><a href ="{{asset('/files/'.$enfant->echantillons) }}">{{$enfant->echantillons}}</a> </td>
                                    <td><a href ="{{asset('/files/'.$enfant->f_genotypage) }}">{{$enfant->f_genotypage}}</a>  </td>
                                
                               

                                        <td>
                                            <a class="btn btn-success btn-sm" type="button" href="{{ route('enfants.edit', ['enfant' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>

                                        </td>

                                </tr>
                            @empty
                                <tr>
                                    <td>Pas de Document!</td>
                                </tr>
                            @endforelse
                        </tbody>@endif
                        @if ( $user_logged_in->profile == 'profil3')
                        <thead class="thead-inverse">
                            <tr>
                                <th>N°Affaire</th>
								     <th>Rapport Bio</th>
                                <th>Décharge Bio</th>
								 @if ( $user_logged_in->name == 'dev')
								  <th>Rapport technique</th>
							  @endif
								     <th>Rapport chimie</th>
                                <th>Décharge chimie</th>
								
                                <th>F.Vérificat°_scellé</th>
                                <th>F.Préparat°_C</th>
                                <th>F.Analyse_résultats</th>
                                <th>F.Préparat°_B</th>
                                <th>F.Extract°</th>
                                <th>F.PCR</th>
                                <th>F.Genotypage</th>
										 @if ( $user_logged_in->name == 'dev')
                                <th>Rapport Medecin légiste</th>
							  <th>Rapport Empreinte digitale</th>
							    <th>Rapport Medecin Balistique</th>
		  @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enfants as $enfant)
                                <tr>
                                    <td>{{ $enfant->num_affaire}}</td>
									       <td><a href ="{{asset('/files/'.$enfant->pdf) }}">{{$enfant->pdf}}</a>  </td>
                             
                                        <td><a href ="{{asset('/files/'.$enfant->conclusion) }}">{{$enfant->conclusion}}</a>  </td> 
										   @if ( $user_logged_in->name == 'dev')
                                        <td><a href ="{{asset('/files/'.$enfant->d) }}">{{$enfant->d}}</a>  </td> 
									  @endif
										<td><a href ="{{asset('/files/'.$enfant->p) }}">{{$enfant->p}}</a>  </td>
                                   
                                        <td><a href ="{{asset('/files/'.$enfant->c) }}">{{$enfant->c}}</a>  </td>
                                    <td><a href ="{{asset('/files/'.$enfant->f_v_scelle) }}">{{$enfant->f_v_scelle}}</a></td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_p) }}">{{$enfant->f_p}}</a> </td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_v_a_resultat) }}">{{$enfant->f_v_a_resultat}}</a>  </td>
                                        <td><a href ="{{asset('/files/'.$enfant->section) }}">{{$enfant->section}}</a></td>
                                        <td><a href ="{{asset('/files/'.$enfant->methode_analyse) }}">{{$enfant->methode_analyse}}</a> </td>
                                        <td><a href ="{{asset('/files/'.$enfant->echantillons) }}">{{$enfant->echantillons}}</a> </td>
                                        <td><a href ="{{asset('/files/'.$enfant->f_genotypage) }}">{{$enfant->f_genotypage}}</a>  </td>
                                 	   @if ( $user_logged_in->name == 'dev')
                                        <td><a href ="{{asset('/files/'.$enfant->rapport_medecin_legiste) }}">{{$enfant->rapport_medecin_legiste}}</a>  </td> 
									       <td><a href ="{{asset('/files/'.$enfant->rapport_emp) }}">{{$enfant->rapport_emp}}</a>  </td> 
										          <td><a href ="{{asset('/files/'.$enfant->rapport_balistique) }}">{{$enfant->rapport_balistique}}</a>  </td> 
									  @endif

                                      

                                </tr>
                            @empty
                                <tr>
                                    <td>Pas de Document ! </td>
                                </tr>
                            @endforelse
                        </tbody>@endif
                </table>
                {{-- {{ $enfants->links() }} --}}
            </div>
        </div>
@endsection

@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp
    <ul>
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
        <li><img src="{{ asset('/emp_images/'. $employe->matricule .'.jpg') }}" width="150px" height="150px"></li>
        
        <li>matricule : {{ $employe->matricule }}</li>
        <li>nni : {{ $employe->nni }}</li>
        <li>nom : {{ $employe->nom }}</li>
        <li>prénom : {{ $employe->prenom }}</li>
        <li>date naissance : {{ $employe->date_naissance }}</li>
        <li style="margin:5px">
            statut : 
            <span style="color: white" class="@if ($employe->statut == '1') bg-success p-2 m-4 @else bg-danger p-2 m-4 @endif">
                @if ($employe->statut == '1')
                    assuré
                @endif
                @if ($employe->statut == '0')
                    non assuré
                @endif
            </span>
        </li>
        @if ($user_logged_in->profile == 'profil1')
                            
        @endif
        @if ($user_logged_in->profile == 'profil2')
            <a  class="btn btn-success btn-sm" type="button" href="{{ route('employes.edit', ['employe' => $employe->id]) }}"><i class="fas fa-edit"></i></a>
        @endif
        @if ($user_logged_in->profile == 'profil3')
            <a  class="btn btn-success btn-sm" type="button" href="{{ route('employes.edit', ['employe' => $employe->id]) }}"><i class="fas fa-edit"></i></a>
            <form method="POST" action="{{ route('employes.destroy', ['employe' => $employe->id]) }}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette carnet ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
            </form>
        @endif
        <li> couples :
            <ul>
                <li>
                    <div class="table-responsive">

                        <table class="table table-striped table-inverse table-sm" width="100%">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>photo</th>
                                    <th>nom</th>
                                    <th>prénom</th>
                                    <th>d_aissance</th>
                                    <th>d_mariage</th>
                                    <th>sexe</th>
                                    <th>nni</th>
                                    <th>statut</th>
                                    @if ($user_logged_in->profile == 'profil1')
                            
                                    @endif
                                    @if ($user_logged_in->profile == 'profil2')
                                        <th>action</th>
                                    @endif
                                    @if ($user_logged_in->profile == 'profil3')
                                        <th>action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employe->couples as $couple)
                                <tr>
                                    <td><img src="{{ asset('/couple_images/'. $couple->nni .'.jpg') }}" width="150px" height="150px"></td>
                                    <td style="white-space: nowrap;">{{ $couple->nom}}</td>
                                    <td style="white-space: nowrap;">{{ $couple->prenom}}</td>
                                    <td style="white-space: nowrap;">{{ $couple->date_naissance }}</td>
                                    <td style="white-space: nowrap;">{{ $couple->date_mariage }}</td>
                                    <td style="white-space: nowrap;">{{ $couple->sexe}}</td>
                                    <td style="white-space: nowrap;">{{ $couple->nni}}</td>
                                    <td class="@if ($couple->statut == '1') assure @else nonAssure @endif">
                                        @if ($couple->statut == '1')
                                        assuré
                                        @endif
                                        @if ($couple->statut == '0')
                                        non assuré
                                        @endif
                                    <td>
                                            @if ($user_logged_in->profile == 'profil1')
                            
                                            @endif
                                            @if ($user_logged_in->profile == 'profil2')
                                                <a class="btn btn-success btn-sm" type="button" href="{{ route('couples.edit', ['couple' => $couple->id]) }}"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if ($user_logged_in->profile == 'profil3')
                                                <a class="btn btn-success btn-sm" type="button" href="{{ route('couples.edit', ['couple' => $couple->id]) }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('couples.destroy', ['couple' => $couple->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer le(la) conjoint(e) ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td><div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <strong>Pas des couples!</strong> desolé y'a pas des déclarations.
                                    </div></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    </li>
            </ul>
        </li>
        <li> enfants :
            <ul>
                <li>
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>photo</th>
                                <th>nom</th>
                                <th>prénom</th>
                                <th>d_naissance</th>
                                <th>scolarisation</th>
                                <th>sexe</th>
                                <th>nni</th>
                                <th>statut</th>
                                @if ($user_logged_in->profile == 'profil1')
                            
                                @endif
                                @if ($user_logged_in->profile == 'profil2')
                                    <th>action</th>
                                @endif
                                @if ($user_logged_in->profile == 'profil3')
                                    <th>action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($employe->enfants as $enfant)
                                <tr>
                                    <td><img src="{{ asset('/enfant_images/'. $enfant->nni .'.jpg') }}" width="150px" height="150px"></td>
                                    <td style="white-space: nowrap;" scope="row">{{ $enfant->nom}}</td>
                                    <td style="white-space: nowrap;">{{ $enfant->prenom}}</td>
                                    <td style="white-space: nowrap;">{{ $enfant->date_naissance}}</td>
                                    <td style="white-space: nowrap;">
                                        @if ($enfant->statut == '1')
                                        scolarisé
                                        @endif
                                        @if ($enfant->statut == '0')
                                        non scloarisé
                                        @endif
                                    </td>
                                    <td style="white-space: nowrap;">{{ $enfant->sexe}}</td>
                                    <td style="white-space: nowrap;">{{ $enfant->nni}}</td>
                                    <td style="white-space: nowrap;" class="@if ($enfant->statut == '1') assure @else nonAssure @endif">
                                        @if ($enfant->statut == '1')
                                        assuré
                                        @endif
                                        @if ($enfant->statut == '0')
                                        non assuré
                                        @endif
                                    </td>
                                    <td style="white-space: nowrap;">
                                        @if ($user_logged_in->profile == 'profil1')
                            
                                        @endif
                                        @if ($user_logged_in->profile == 'profil2')
                                            <a class="btn btn-success btn-sm" type="button" href="{{ route('enfants.edit', ['enfant' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if ($user_logged_in->profile == 'profil3')
                                            <a class="btn btn-success btn-sm" type="button" href="{{ route('enfants.edit', ['enfant' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('enfants.destroy', ['enfant' => $enfant->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'enfant ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Pas enfants!</strong> desolé y'a pas des déclarations.
                                            </div>
                                    </td>
                                    </tr>
                                @endforelse
                            </tbody>
                    </table>
                </li>
            </ul>
        </li>
    </ul>
@endsection

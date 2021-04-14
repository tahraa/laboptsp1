@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp
    <ul>
        <li><img src="{{ asset('/couple_images/'. $couple->nni .'.jpg') }}" width="150px" height="150px"></li>
        
        <li>nni : {{ $couple->nni }}</li>
        <li>nom : {{ $couple->nom }}</li>
        <li>prénom : {{ $couple->prenom }}</li>
        <li>
            statut : 
            @if ($couple->statut == '1')
                assuré
            @endif
            @if ($couple->statut == '0')
                non assuré
            @endif
        </li>
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
        @php $emp = \App\Employe::find($couple->employe_id) @endphp

        <li> employé :
            <ul>
                <li>
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>photo</th>
                                <th>matricule</th>
                                <th>nom</th>
                                <th>prénom</th>
                                <th>sexe</th>
                                <th>nni</th>
                                <th>statut</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="{{ asset('/emp_images/'. $emp->matricule .'.jpg') }}" width="150px" height="150px"></td>
                                    <td scope="row">{{ $emp->matricule}}</td>
                                    <td scope="row">{{ $emp->nom}}</td>
                                    <td>{{ $emp->prenom}}</td>
                                    <td>{{ $emp->sexe}}</td>
                                    <td>{{ $emp->nni}}</td>
                                    <td>
                                        @if ($emp->statut == '1')
                                            assuré
                                        @endif
                                        @if ($emp->statut == '0')
                                            non assuré
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </li>
            </ul>
        </li>
    </ul>
@endsection

@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <div class="container">
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
                @if (Session::has('denied'))
                <div class="alert alert-danger text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('denied') }}</p>
                </div>
                @endif
                <h4 class="card-title">Liste des conjoints des Bénéficiers</h4>
                <p class="card-text text-success font-weight-bold">Total : {{ $count_couples}}</p>
                {{ $couples ->links() }}
                <table
                    class="table"
                    data-toggle="table"
                    data-pagination="false"
                    data-search="true"
                    data-locale="fr-FR"
                        >
                    <thead class="thead-inverse">
                        <tr>
                            <th data-sortable="true">Photo</th>
                            <th data-field="matricule" data-sortable="true">mat </th>
                            <th data-field="nom" data-sortable="true">nom & prénom</th>
                           {{--  <th data-field="sexe" data-sortable="true">sexe</th> --}}
                            <th data-field="sexe" data-sortable="true">Numéro cnam</th>
                            <th data-field="statut">statut</th>
                            @if ($user_logged_in->profile == 'profil2')
                                <th>action</th>
                            @endif
                            @if ($user_logged_in->profile == 'profil3')
                                <th>action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($couples as $couple)
                                <tr>
                                    {{-- <td><img src="{{ asset('/couple_images/'. $couple->nni .'.jpg') }}" width="100px" height="100px"></td> --}}
                                    <td>
                                        @if ($couple->image == null)
                                        <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                                        @else
                                            <img src="{{ asset('/couple_images/'.$couple->nni.'.jpg') }}" width="100px" height="100px">
                                        @endif
                                    </td>
                                    <td><a href="{{ route('couplesB.show', ['couplesB' => $couple->id]) }}">{{ $couple->matricule }}</a></td>
                                    <td>{{ $couple->prenom .' '. $couple->nom  }}</td>

                              {{--       <td>{{ $couple->sexe }}</td> --}}

                                    <td>{{ $couple->num_cnam }}</td>
                                    <td class="@if ($couple->statut == '1')assure @else nonAssure @endif">
                                        @if ($couple->statut == '1')
                                        <i class="fas fa-check"></i> assuré
                                        @endif
                                        @if ($couple->statut == '0')
                                        <i class="fas fa-times"></i> non assuré
                                        @endif
                                    </td>

                                    @if ($user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil2')
                                    <td>
                                        <a class="btn btn-success btn-sm" type="button" href="{{ route('couplesB.edit', ['couplesB' => $couple->id]) }}"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('couplesB.destroy', ['couplesB' => $couple->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer le(la) conjoint(e) ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des conjoints</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
                {{-- {{ $couplesB.>links() }} --}}
            </div>
        </div>
    </div>
@endsection

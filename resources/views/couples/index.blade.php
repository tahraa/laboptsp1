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
                <h4 class="card-title">Liste des conjointes</h4>
                <p class="card-text text-success font-weight-bold">Total : {{ $count_couples }}</p>

                <table
                    class="table"
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true"
                    data-locale='fr-FR'
                    data-pagination-h-align="left"
                    data-pagination-detail-h-align="right"
                    data-page-list="[5, 10, 25, 50, 100, 200, All]"
                        >
                    <thead class="thead-inverse">
                        <tr>
                            <th data-sortable="true">Photo</th>
                            <th data-field="nni">nni</th>
                            <th data-field="nom">nom</th>
                            <th data-field="prenom">prenom</th>
                            <th data-field="statut">statut</th>
                            <th>sexe</th>
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
                            @forelse ($couples as $couple)
                                <tr>
                                    <td><img src="{{ asset('/couple_images/'. $couple->nni .'.jpg') }}" width="100px" height="100px"></td>
                                    <td><a href="{{ route('couples.show', ['couple' => $couple->id]) }}">{{ $couple->nni }}</a></td>
                                    <td>{{ $couple->nom }}</td>
                                    <td>{{ $couple->prenom }}</td>
                                    <td>
                                        @if ($couple->statut == '1')
                                            assuré
                                        @endif
                                        @if ($couple->statut == '0')
                                            non assuré
                                        @endif
                                    </td>
                                    <td>{{ $couple->sexe }}</td>
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
                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des conjoints(e)</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
                {{-- {{ $couples->links() }} --}}
            </div>
        </div>
    </div>
@endsection

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
                <h4 class="card-title">Liste des enfants</h4>
                <p class="card-text text-success font-weight-bold">Total : {{ $count_enfants }}</p>
                {{ $enfants->links() }}
                <table
                    class="table"
                    data-toggle="table"
                    data-pagination="false"
                    data-search="true"
                    data-locale="fr-FR"
                    {{-- data-pagination-h-align="left" --}}
                    {{-- data-pagination-detail-h-align="right" --}}
                    {{-- data-page-list="[5, 10, 25, 50, 100, 200, All]" --}}
                        >
                        <thead class="thead-inverse">
                            <tr>
                                <th data-field="photo">Photo</th>
                                <th data-field="matricule" data-sortable="true">mat </th>
                                <th data-field="nom" data-sortable="true">nom & prénom</th>
                                <th data-field="sexe" data-sortable="true">sexe</th>
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
                            @forelse ($enfants as $enfant)
                                <tr>
                                    {{-- <td><img src="{{ asset('/enfant_images/'. $enfant->nni .'.jpg') }}" width="100px" height="100px"></td> --}}
                                    <td>
                                        @if ($enfant->image == null)
                                            <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                                        @else
                                            <img src="{{ asset('/enfant_images/'.$enfant->nni.'.jpg') }}" width="100px" height="100px">
                                        @endif                                    </td>
                                    <td><a href="{{ route('enfantsB.show', ['enfantsB' => $enfant->id]) }}">{{ $enfant->matricule }}</a></td>
                                    <td>{{ $enfant->prenom.' '.$enfant->nom }}</td>
                                    <td>{{ $enfant->sexe }}</td>
                                    <td class="@if ($enfant->statut == '1') assure @else nonAssure @endif">
                                        @if($enfant->statut == '1')
                                            Assuré
                                        @endif
                                        @if($enfant->statut == '0')
                                            Non assuré
                                        @endif
                                    </td>
                                  {{--   @if ($user_logged_in->profile == 'profil2')
                                        <td>
                                            <a class="btn btn-success btn-sm" type="button" href="{{ route('enfantsB.edit', ['enfant' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>
                                        </td>
                                    @endif --}}
                                    @if ($user_logged_in->profile == 'profil3'||$user_logged_in->profile == 'profil3')
                                        <td>
                                            <a class="btn btn-success btn-sm" type="button" href="{{ route('enfantsB.edit', ['enfantsB' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('enfantsB.destroy', ['enfantsB' => $enfant->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'enfant ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des enfants</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
                {{-- {{ $enfants->links() }} --}}
            </div>
        </div>
@endsection

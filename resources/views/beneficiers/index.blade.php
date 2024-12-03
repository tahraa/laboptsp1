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
                @if (Session::has('denied'))
                    <div class="alert alert-danger text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('denied') }}</p>
                    </div>
                @endif
                <h4 class="card-title">Liste des livrets de tiers</h4>

            <p class="card-text text-success font-weight-bold">Total : {{ $count_beneficiers }}</p>
            {{ $beneficiers->links() }}
                <table

                        class="table"
                        data-toggle="table"
                        data-pagination="false"
                        data-search="true"
                        data-locale='fr-FR'
                        {{-- data-pagination-h-align="left" --}}
                        {{-- data-pagination-detail-h-align="right" --}}
                        {{-- data-page-list="[5, 10, 25, 50, 100, 200, All]" --}}
                        >
                    <thead class="thead-inverse">
                        <tr>
                            <th data-sortable="true">Photo</th>
                            <th data-sortable="true">matricule</th>
                            <th data-field="nom">nom & prénom</th>
                            <th>sexe</th>
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
                            @forelse ($beneficiers as $beneficier)
                                <tr>
                                    <td><img src="{{ asset('/emp_images/'. $beneficier->matricule .'.jpg') }}" width="100px" height="100px"></td>
                                    <td><a href="{{ route('beneficier.show', ['beneficier' => $beneficier->id]) }}">{{ $beneficier->matricule }}</a></td>
                                    <td>{{ $beneficier->prenom.' '.$beneficier->nom  }}</td>
                                    <td>{{ $beneficier->sexe }}</td>
                                    <td class="@if ($beneficier->statut == '1') assure @else nonAssure @endif">
                                        @if ($beneficier->statut == '1')
                                        <i class="fas fa-check"></i> assuré
                                        @endif
                                        @if ($beneficier->statut == '0')
                                        <i class="fas fa-times"></i> non Assuré
                                        @endif
                                    </td>
                                        @if ($user_logged_in->profile == 'profil2')
                                            <td>
                                                <a  class="btn btn-success btn-sm" type="button" href="{{ route('beneficier.edit', ['beneficier' => $beneficier->id]) }}"><i class="fas fa-edit"></i></a>
                                            </td>
                                        @endif


                                        @if ($user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil2')
                                      <td>
                                            <a  class="btn btn-success btn-sm" type="button" href="{{ route('beneficier.edit', ['beneficier' => $beneficier->id]) }}"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('beneficier.destroy', ['beneficier' => $beneficier->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette carnet ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                        @endif
                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des livrets</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>

            </div>
        </div>
@endsection

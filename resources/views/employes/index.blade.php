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
                <h4 class="card-title">Liste des livrets</h4>

            <p class="card-text text-success font-weight-bold">Total : {{ $count_employes }}</p>
            {{ $employes->links() }}
          
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
                            <th>service</th>
                            <th data-field="statut">statut</th>
                           
                            @if ($user_logged_in->profile == 'profil3' && $user_logged_in->name == 'dev')
                                <th>action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($employes as $employe)
                                <tr>
                                    <td><img src="{{ asset('/emp_images/'. $employe->matricule .'.jpg') }}" width="100px" height="100px"></td>
                                    <td>
                                        @php
                                            $age = Carbon\Carbon::parse($employe->date_naissance)->age;
                                        @endphp
                                    <a 
                                        href="{{ route('employes.show', ['employe' => $employe->id]) }}" 
                                        data-toggle="tooltip" 
                                        data-html="true"
                                        title="
                                        {{$employe->prenom.' '.$employe->nom}} <br>
                                        {{ 'SERVICE : '.$employe->service }} <br>
                                        {{ 'AGE : '.$age .' ans'}}
                                        "
                                        >
                                        {{ $employe->matricule }}
                                    </a>
                                    </td>
                                    <td>{{ $employe->prenom.' '.$employe->nom  }}</td>
                                    <td>{{ $employe->service }}</td>
                                    <td class="@if ($employe->statut == '1') assure @else nonAssure @endif">
                                        @if ($employe->statut == '1')
                                        <i class="fas fa-check"></i> assuré
                                        @endif
                                        @if ($employe->statut == '0')
                                        <i class="fas fa-times"></i> non Assuré
                                        @endif
                                    </td>
                   

                                        @if ($user_logged_in->profile == 'profil3' && $user_logged_in->name == 'dev')
                                        <td>
                                            <a  class="btn btn-success btn-sm" type="button" href="{{ route('employes.edit', ['employe' => $employe->id]) }}"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('employes.destroy', ['employe' => $employe->id]) }}">
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

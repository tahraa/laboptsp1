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
                <form action="{{ route('getSearch') }}" method="POST" class="form-inline">
                    @csrf
                   <div class="form-group mb-2">
                       <label for="field" class="sr-only">Champ de selection</label>
                       <select class="form-control-plaintext" name="field" id="field">
                           <option value="matricule">matricule</option>
                       </select>
                   </div>
                   <div class="form-group mx-sm-3 mb-2">
                       <label for="q" class="sr-only">keyword</label>
                       {{-- <input name="q" type="text" class="form-control" id="q" placeholder="keyword..."/> --}}
                       <select name="q" style="width: 125px" required="required" id="q"  class="form-control selectemp">
                           <option value="vide">-------</option>
                           @forelse ($employes as $employe)
                               <option  value="{{$employe->matricule}}">
                                   {{$employe->matricule}}
                               </option>
                           @empty
           
                           @endforelse
                       </select>
                   </div>
                   <button type="submit" class="btn btn-primary mb-2">Chercher</button>
               </form>
            <p class="card-text text-success font-weight-bold">Total : {{ $count_employes }}</p>

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
                            <th data-sortable="true">matricule</th>
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
                            @forelse ($employes as $employe)
                                <tr>
                                    <td><img src="{{ asset('/emp_images/'. $employe->matricule .'.jpg') }}" width="100px" height="100px"></td>
                                    <td><a href="{{ route('employes.show', ['employe' => $employe->id]) }}">{{ $employe->matricule }}</a></td>
                                    <td>{{ $employe->nni }}</td>
                                    <td>{{ $employe->nom }}</td>
                                    <td>{{ $employe->prenom }}</td>
                                    <td class="@if ($employe->statut == '1') assure @else nonAssure @endif">
                                        @if ($employe->statut == '1')
                                            assuré
                                        @endif
                                        @if ($employe->statut == '0')
                                            non Assuré
                                        @endif
                                    </td>
                                    <td>{{ $employe->sexe }}</td>
                                    <td>
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des livrets</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
                {{-- {{ $employes->links() }} --}}
            </div>
        </div>
@endsection

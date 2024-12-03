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
                <h4 class="card-title">Liste des Echantillons</h4>

            <p class="card-text text-success font-weight-bold">Total : {{ $count_commissariats }}</p>
            {{ $commissariats->links() }}

                <table

                        class="table"
                        data-toggle="table"
                        data-pagination="false"
                        data-search="true"
                        data-locale='fr-FR'
                        >
                    <thead class="thead-inverse">
                        <tr>
                            <th data-sortable="true">N°echantillon</th>
							 <th   data-sortable="true">N°Scellé</th>
                            <th data-sortable="true">N°affaire</th>
							     <th  data-sortable="true">Déscription</th>
							     <th   data-sortable="true">Etat</th>
								  <th  data-sortable="true">Periode de conservation</th>
								 <th   data-sortable="true">Traité</th>
                        



                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($commissariats as $employe)
                                <tr>

                                    <td>{{$employe->num_echantillon  }}</td>
								     <td>{{$employe->num_scelle  }}</td>
                                    <td>{{ $employe->num_affaire }}</td>
                                    <td> {{$employe->description}}</td>
                                    <td>{{ $employe->etat }}</td>
                                    <td> {{$employe->periode_conservation}}</td>
									<td>{{$employe->traite}}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td>Pas de Echantillons</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>

            </div>
        </div>
@endsection

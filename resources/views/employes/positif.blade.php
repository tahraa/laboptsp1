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
                <h4 class="card-title">Liste des affaires En cours</h4>

            <p class="card-text text-success font-weight-bold">Total: {{ $count_emps }}</p>
		
            {{ $emps->links() }}

                <table

                        class="table"
                        data-toggle="table"
                        data-pagination="false"
                        data-search="true"
                        data-locale='fr-FR'

                        >
                    <thead class="thead-inverse">
                        <tr>
                            <th data-sortable="true">N°affaire</th>
                            <th data-sortable="true">Type</th>
                            <th data-sortable="true">Date</th>

                            <th >Partie declarent</th>


                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($emps as $employe)
                                <tr>

                                    <td><a href="{{ route('employes.show', ['employe' => $employe->id]) }}">{{ $employe->num_affaire  }}</a></td>




                                    <td>{{ $employe->Type  }}</td>
                                    <td>{{ $employe->Date }}</td>
                                     <td>{{ $employe->Partie_declarent }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des affaires</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>

            </div>
        </div>
@endsection

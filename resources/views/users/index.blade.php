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
                
                <h4 class="card-title">Liste des utilisateurs</h4>
            
            <p class="card-text text-success font-weight-bold">Total : {{ $count_users }}</p>

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
                            <th data-field="nni">username</th>
                            <th data-field="nom">email</th>
                            <th data-field="prenom">date_création</th>
                            <th data-field="prenom">profil</th>
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
                            @forelse ($users as $user)
                                <tr>
                                    <td><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        date_création : {{ date('d-m-Y', strtotime($user->created_at)) }}

                                    </td>
                                    <td>{{ $user->profile }}</td>
                                    <td>
                                        @if ($user_logged_in->profile == 'profil1')
                            
                                        @endif
                                        @if ($user_logged_in->profile == 'profil2')
                                            <a  class="btn btn-success btn-sm" type="button" href="{{ route('users.edit', ['user' => $user->id]) }}"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if ($user_logged_in->profile == 'profil3')
                                        <a  class="btn btn-success btn-sm" type="button" href="{{ route('users.edit', ['user' => $user->id]) }}"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'utilisateur ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des utilisateurs</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
@endsection

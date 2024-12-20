@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp
    <ul>
        @if (Session::has('success'))
            <div class="container alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        @if (Session::has('denied'))
            <div class="container alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('denied') }}</p>
            </div>
        @endif
 <small class="text-center"><strong class="font-weight-bold text-primary">profile1:</strong> <strong class="text-info">Biologie</strong></small>
     <small class="text-center"><strong class="font-weight-bold text-primary"> profile2: </strong> <strong class="text-info">chimie</strong></small>
 <small class="text-center"><strong class="font-weight-bold text-primary"> profile3:</strong> <strong class="text-info">informatique</strong></small>
  
       
        <li>username : {{ $user->name }}</li>
        <li>email : {{ $user->email }}</li>
        <li>profile : {{ $user->profile}}</li>
        <li>date_création : {{ date('d-m-Y h:m:s', strtotime($user->created_at)) }}</li>
        <li>dernier_modification : {{ date('d-m-Y h:m:s', strtotime($user->updated_at)) }}</li>
        <li>
            
        
            @if ($user_logged_in->profile == 'profil3')
            <a  class="btn btn-success btn-sm" type="button" href="{{ route('users.editt', ['user' => $user->id]) }}"><i class="fas fa-edit"></i></a>
            <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'utilisateur ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
            </form>
            @endif
        </li>
    </ul>
@endsection

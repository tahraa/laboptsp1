@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp
    <div class="justify-content-center">
            <div class="card">
                @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3' || $user_logged_in->profile == 'profil1')
      
                <div class="card-header text-primary">Utilisateurs/Modifier le mot de passe</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', ['user'=>$user->id]) }}">
                        @csrf
                        @method('PUT')
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
                        {{-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name ?? null) }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email ?? null) }}" required autocomplete="email">
                            </div>
                        </div> --}}

                        <input type="hidden" name="old_password" value="{{ $user->password }}">
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Ancien Mot de passe</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="entred_password"  autocomplete="new-password" placeholder="entrez l'ancien mot de passe">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nouveau mot de passe</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="nv_password"  autocomplete="new-password" placeholder="entrez le nouveau mot de passe">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Modifier
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="alert alert-warning" role="alert">
                    Vous n'avez pas l'accès à cette page.
                </div>
                @php
                    header("Location: " . URL::to('/'), true, 302);
                    exit();
                @endphp
                @endif
            </div>
    </div>
@endsection

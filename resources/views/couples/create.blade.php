@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
        <div class="card-header text-primary"><h2>Ajouter/Conjoint(e) </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('couples.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                {{-- <p>Employé:  nombre couple : {{ $employe->couples_count }}   nombre enfants : {{ $employe->enfants_count }}</p> --}}
                <div class="table-responsive">
                <table class="table table-bordered table-sm w-auto" id="">
                    <tr>
                        <th>nni</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>statut</th>
                        <th>sexe</th>
                        <th>date naissance</th>
                        <th>date mariage</th>
                        <th style="width: 100px">Employé</th>
                        <th>photo</th>
                    </tr>
                    <tr>
                        <td ><input style="width: 125px"  maxlength="10" required="required" type="text" name="nni" placeholder="Enter nni" class="form-control" value="{{ old('nni') }}"/></td>
                        <td><input style="width: 125px" required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom') }}"/></td>
                        <td><input style="width: 125px" required="required" type="text" name="prenom" placeholder="Enter prénom" class="form-control" value="{{ old('prenom') }}"/></td>
                        <td><select style="width: 125px" required="required" name="statut" id="" class="form-control"><option  value="1"  >assuré</option><option value="0" >non assuré</option></select></td>
                        <td><select style="width: 125px" required="required" name="sexe" id="" class="form-control"><option  value="masculin">masculin</option><option value="feminin">féminin</option></select></td>
                        <td><input style="width: 200px" required="required"  type="date" name="date_naissance" class="form-control" /></td>
                        <td><input style="width: 200px" required="required"  type="date" name="date_mariage" class="form-control" /></td>
                        <td>
                            <select style="width: 125px" required="required" id="" name="employe" class="form-control selectemp">
                                <option value="vide">-------</option>
                                @forelse ($employes as $employe)
                                    <option  value="{{$employe->id}}">
                                        {{$employe->matricule}}
                                    </option>
                                @empty

                                @endforelse
                            </select>
                            <script>
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2();
                            });
                            </script>
                        </td>
                        <td><input style="width: 400px" required="required"  type="file" name="c_image" class="form-control" value="{{ old('emp_image') }}"/></td>
                    </tr>
                </table>
            </div>
                <button type="submit" class="btn btn-success">Enregistrer</button>
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
@endsection
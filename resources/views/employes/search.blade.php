@extends('layout')
@section('content')
@php
$user_id = auth()->user()->id;
$user = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
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
    <div class="container mt-3">
        <h2>Chercher</h2>
        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">matricule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">nni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">prenom</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div id="home" class="container tab-pane active"><br>
            <h3>matricule</h3>
            <form action="{{ route('getSearch') }}" method="POST" class="form-inline">
                @csrf
               <div class="form-group mb-2">
                    <input type="hidden" name="field" value="matricule">
                    <label for="field" class="">Entité de selection</label>
                    <select class="form-control-plaintext" name="entite" id="field">
                        <option value="emp">Agent</option>
                        <option value="ben">Bénéficier</option>
                    </select>
               </div>
               <div class="form-group mx-sm-3 mb-2">
                   <select name="q" style="width: 125px" required="required" id="q"  class="form-control selectemp_mat" data-select2-id="matricule">
                       <option value="vide">-------</option>
                       @forelse($employes as $employe)
                       @if ($user->profile == 'profil2')
                            @if($user->etablissement == $employe->etablissement)
                                <option  value="{{$employe->matricule}}">
                                        {{$employe->matricule}}
                                </option>
                            @endif
                       @else
                            <option  value="{{$employe->matricule}}">
                                {{$employe->matricule}}
                            </option>
                       @endif
                       @empty
                       @endforelse

                       @forelse ($beneficiers as $beneficier)
                       @if ($user->profile == 'profil2')
                           @if($user->etablissement == $beneficier->etablissement)
                            <option  value="{{$beneficier->matricule}}">
                                 {{$beneficier->matricule}}
                            </option>
                           @endif
                       @else  
                             <option  value="{{$beneficier->matricule}}">
                                 {{$beneficier->matricule}}
                             </option>
                       @endif
                       @empty
                       @endforelse
                   </select>
               </div>
               <button type="submit" class="btn btn-primary mb-2">Chercher</button>
           </form>
          </div>
          <div id="menu1" class="container tab-pane fade"><br>
            <h3>nni</h3>
            <form action="{{ route('getSearch') }}" method="POST" class="form-inline">
                @csrf
               <div class="form-group mb-2">
                   <input type="hidden" name="field" value="nni">
                   <label for="field" class="">Entité de selection</label>
                   <select class="form-control-plaintext" name="entite" id="field">
                       <option value="emp">Agent</option>
                       <option value="ben">Bénéficier</option>
                   </select>
               </div>
               <div class="form-group mx-sm-3 mb-2">
                   <select name="q" style="width: 125px" required="required" id="q"  class="form-control selectemp_nni" data-select2-id="nni">
                       <option value="vide">-------</option>
                       @forelse ($employes as $employe)
                           <option  value="{{$employe->nni}}">
                               {{$employe->nni}}
                           </option>
                       @empty
                       @endforelse
                       @forelse ($beneficiers as $beneficier)
                           <option  value="{{$beneficier->matricule}}">
                               {{$beneficier->matricule}}
                           </option>
                       @empty
                       @endforelse
                   </select>
               </div>
               <button type="submit" class="btn btn-primary mb-2">Chercher</button>
           </form>
          </div>
          <div id="menu2" class="container tab-pane fade"><br>
            <h3>prenom</h3>
            <form action="{{ route('getSearch') }}" method="POST" class="form-inline">
                @csrf
               <div class="form-group mb-2">
                    <input type="hidden" name="field" value="prenom">
                   <label for="field" class="">Entité de selection</label>
                    <select class="form-control-plaintext" name="entite" id="field">
                        <option value="emp">Agent</option>
                        <option value="ben">Bénéficier</option>
                    </select>
               </div>
               <div class="form-group mx-sm-3 mb-2">
                   <select name="q" style="width: 125px" required="required" id="q"  class="form-control selectemp_prenom" data-select2-id="prenom">
                       <option value="vide">-------</option>
                       @forelse ($employes as $employe)
                           <option  value="{{$employe->prenom}}">
                               {{$employe->prenom}}
                           </option>
                       @empty
                       @endforelse
                       @forelse ($beneficiers as $beneficier)
                           <option  value="{{$beneficier->matricule}}">
                               {{$beneficier->matricule}}
                           </option>
                       @empty
                       @endforelse
                   </select>
               </div>
               <button type="submit" class="btn btn-primary mb-2">Chercher</button>
           </form>
          </div>
        </div>
      </div>

</div>
@endsection

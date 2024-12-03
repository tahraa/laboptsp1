@extends('layout')
@section('content')
@php
$user_id = auth()->user()->id;
$user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <div class="card">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil1')
        <div class="card-header text-primary"><h2>Ajouter/commissariat </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
            <form action="{{ route('commissariats.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="table-responsive">

                        <div class="form-group">
                          <label for="nom">nom</label>
                          <input id="nom"  required="required" type="text" name="nom" placeholder="Enter nom" class="form-control" value="{{ old('nom') }}"/>
                        </div>

                        <div class="form-group">
                          <label for="region">Direction regionnale de la sûreté</label>
                        <select  id="region" required="required" type="text" name="region" class="form-control"><option value=" "></option><option value="NKTT(OUEST)">NKTT(OUEST)</option><option value="NKTT(NORD)" >NKTT(NORD)</option><option value="NKTT(SUD)">NKTT(SUD)</option><option value="Adrar">ADRAR</option><option value="BRAKNA">BRAKNA</option><option value="HODH EL GHARBI">HODH EL GHARBI</option><option value="ASSABA">ASSABA</option><option value="TAGANET">TAGANET</option><option value="NDB">DAKHLET NOUADHIBOU</option><option value="TRARZA">TRARZA</option><option value="GORGOL">GORGOL</option><option value="GUIDIMAKA">GUIDIMAKA</option><option value="HODH EL CHARGUI">HODH EL CHARGUI</option><option value="INCHIRI">INCHIRI</option><option value="TIRIZZEMOUR">TIRIZZEMOUR</option></select></td>

                        </div>

                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input id="contact" type="text" name="contact" placeholder="Entrer contact" class="form-control" value="{{ old('prenom') }}"/>
                          </div>



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

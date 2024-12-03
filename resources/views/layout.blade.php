<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LIVRET FAMILIAL VERSION ELECTRONIQUE">
    <meta name="keywords" content="Livret, Familial, snim">
    <meta name="author" content=" Tahra Mohamed Yahya ">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/brands.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/regular.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/solid.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/svg-with-js.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/v4-shims.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/v4-shims.min.css') }}">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('/css/roboto_mono.css') }}">
    <!-- <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-table.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css" integrity="sha512-MMojOrCQrqLg4Iarid2YMYyZ7pzjPeXKRvhW9nZqLo6kPBBTuvNET9DBVWptAo/Q20Fy11EIHM5ig4WlIrJfQw==" crossorigin="anonymous" /> --}}
    <link rel="stylesheet" href="{{ asset('/css/selectize.bootstrap4.min.css') }}"> 
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body{
            font-family: 'Roboto Mono', monospace;
            height: 100%;
            
        }
        .select,
        #locale {
            width: 100%;
        }
        .like {
            margin-right: 10px;
        }

        .assure {
        position: relative;
         background-color:rgb(255,0,0);opacity:0.6; 
        background-color: hsla(120, 100%, 50%, 0.3);
        /* left: 0.7em; */
        /* right: 0.7em; */
        height: 1.2em;
        text-align: center;
        }
        .nonAssure {
        position: relative;
        /* background-color:rgb(255,0,0);opacity:0.6; */
        background-color: hsla(9, 87%, 56%, 0.5);
        /* left: 0.7em; */
        /* right: 0.7em; */
        height: 1.2em;
        text-align: center;
        }

        ul {
        list-style-type: none;
        margin: 0;
        padding: 1.5px;
        }


        /* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript,
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url("{{ asset('images/loader9.gif') }}") center no-repeat #fff;
    /* background-size: 75px 75px; */
}
    </style>
</head>



<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <!-- Paste this code after body tag -->
	<div class="loader"></div>
	<!-- Ends -->
    @php
        $user_id = auth()->user()->id;
        $user = \App\User::where(['id' => $user_id])->first();
    @endphp
    
 <header class="main-header">
    <div id="app">
    <div class="container">
      
          <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm" style="color:white">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
             <div class="container">
                <a style="color:white" class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} <span class="text-center" style="font-size: 10px">(LIVRET FAMILIAL VERSION ELECTRONIQUE)</span></br><span class="text-center" style="direction:rtl; margin-left:5px; font-family: 'Tajawal', sans-serif; font-size: 22px">         دفتر القيد الأسري النسخة الرقمية </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                        <!-- Right Side Of Navbar -->
                     <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a style="color:white" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li> 
                        @endif
                        @else
                            
                            <li class="nav-item dropdown">
                                <a style="color:white" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="glyphicon glyphicon-user"></span>
                                    {{ Auth::user()->profile.'/'.Auth::user()->name  }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.edit', ['user'=>$user_id]) }}">
                                    <i class="fa fa-edit" style="color:#3A82E3"></i>
                                        Modifier profile
                                   </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();"><i class="fa fa-power-off" style="color:#F94A59"></i>
                                        Déconnexion
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            
            <marquee class="text-primary font-weight-bold" width="100%" direction="left" height="50px">
                Bienvenue au nouveau Site Intranet Livret Familial de la SNIM <img src="{{ asset('/images/logo.png') }}" width="20px" height="20px" alt="">.
            </marquee>
        </div>
        </div>
    </header>
        <div class="container border">
        <div class="row">
                <div class="col-md-3 p-2">
                @if ($user->profile == 'profil2'||$user->profile == 'profil3')
                    <small class="text-center"><strong class="font-weight-bold text-primary">L.</strong> <strong class="text-info">: LISTE</strong></small>
                    <small class="text-center"><strong class="font-weight-bold text-primary">A.</strong> <strong class="text-info">: AJOUTER</strong></small>
                 @endif 
                    <ul class=" border p-4">
                         <li class="">
                                <a class="" href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i>&nbsp;Accueil</a>
                            </li>

                        @if ($user->profile == 'profil1')
                            <li class="">
                                <a class="" href="{{ route('search') }}"><i class="fas fa-search" aria-hidden="true"></i> Chercher</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil2')
                            <li class="">
                                <a class="" href="{{ route('search') }}"><i class="fas fa-search"></i> Chercher</a>
                            </li>
                            <li class="">
                                <a class=" active" href="{{ route('employes.index') }}"><i class="fas fa-book-open"></i> L.Livrets AGENTS</a>
                            </li>
                            <li class="">
                                <a class=" active" href="{{ route('beneficier.index') }}"><i class="fas fa-book-open"></i> L.Livrets TIERS</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('employes.create') }}"><i class="fas fa-book-open"></i> Créer un livret</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('empone.create') }}"><i class="fas fa-plus-circle"></i> A.Employé</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('beneficier.create') }}"><i class="fas fa-plus-circle"></i> A.TIERS</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil3')
                        <li class="">
                            <a class="" href="{{ route('search') }}"><i class="fas fa-search"></i> Chercher</a>
                        </li>
                        <li class="">
                            <a class=" active" href="{{ route('employes.index') }}"><i class="fas fa-book-open"></i> L.Livrets AGENTS</a>
                        </li>
                          <li class="">
                            <a class=" active" href="{{ route('beneficier.index') }}"><i class="fas fa-book-open"></i> L.Livrets TIERS</a>
                        </li>
                        <li class="">
                            <a class="" href="{{ route('employes.create') }}"><i class="fas fa-address-card"></i> A.Livret</a>
                        </li>

                        <li class="">
                            <a class="" href="{{ route('empone.create') }}"><i class="fas fa-plus-circle"></i> A.Employé</a>
                        </li>
                       <li class="">
                         <a class=""  href="{{ route('beneficier.create') }}"><i class="fas fa-plus-circle"></i> A.TIERS</a>
                        </li>
                        @endif
                    </ul>
                    @if ($user->profile == 'profil2'|| $user->profile == 'profil3')
                        <ul class=" border p-4">
                        @if ($user->profile == 'profil2')
                            <li class="">
                                <a class=" active" href="{{ route('couples.index') }}"><i class="fas fa-list"></i> L.Conjs</a>
                            </li>
                            <li class="">
                                <a class=" active" href="{{ route('couplesB.index') }}"><i class="fas fa-list"></i> L.Conj TIERSs</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('couples.create') }}"><i class="fas fa-plus-circle"></i> A.Conj </a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('couplesB.create') }}"><i class="fas fa-plus-circle"></i> A.Conj TIERS</a>
                            </li>
                        @endif

                        @if ($user->profile == 'profil3')
                            <li class="">
                                <a class=" active" href="{{ route('couples.index') }}"><i class="fas fa-list"></i> L.Conjs</a>
                            </li>
                            <li class="">
                                <a class=" active" href="{{ route('couplesB.index') }}"><i class="fas fa-list"></i> L.Conjs TIERS</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('couples.create') }}"><i class="fas fa-plus-circle"></i> A.Conj</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('couplesB.create') }}"><i class="fas fa-plus-circle"></i> A.Conj TIERS</a>
                            </li>
                        @endif


                        @if ($user->profile == 'profil2')
                            <li class="">
                                <a class="" href="{{ route('enfants.index') }}"><i class="fas fa-list"></i> L.Enfants</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfantsB.index') }}"><i class="fas fa-list"></i> L.Enfants TIERS</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfantsB.create') }}"><i class="fas fa-plus-circle"></i> A.Enfant</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfantsB.create') }}"><i class="fas fa-plus-circle"></i> A.Enfant TIERS</a>
                            </li>
                        @endif

                        @if ($user->profile == 'profil3')
                            <li class="">
                                <a class="" href="{{ route('enfants.index') }}"><i class="fas fa-list"></i> L.Enfants</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfantsB.index') }}"><i class="fas fa-list"></i> L.Enfants TIERS</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfants.create') }}"><i class="fas fa-plus-circle"></i> A.Enfant</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfantsB.create') }}"><i class="fas fa-plus-circle"></i> A.Enf TIERS</a>
                            </li>
                        @endif
                        </ul>
                    @endif

                    @if ( $user->profile == 'profil3')
                        <ul class=" border p-4">
                        @if ($user->profile == 'profil3')
                        <li class="">
                            <a  href="{{ route('users.index') }}"><i class="fas fa-users"></i> L.Utilisateurs</a>
                        </li>
                        <li class="">
                            <a  href="{{ route('logs.index') }}"><i class="fas fa-list"></i> Logs</a>
                        </li>
                        <li class="">
                            <a  href="{{ route('users.create') }}"><i class="fas fa-plus-circle"></i> A.Utilisateur</a>
                        </li>
                        @endif
                        </ul>
                    @endif
                @if ( $user->profile == 'profil3')
                    <ul class="border p-4">
                        @if ($user->profile == 'profil3')
                                <li class="">
                                    <a  href="{{ route('employes-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export Emps</a>
                                </li>
                                <li class="">
                                    <a  href="{{ route('couples-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export Conjs</a>
                                </li>
                                <li class="">
                                    <a  href="{{ route('enfants-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export Enfs</a>
                                </li>
                                <li class="">
                                    <a  href="{{ route('beneficiers-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export Tiers</a>
                                </li>
                                <li class="">
                                    <a  href="{{ route('couplesb-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export C.Tiers</a>
                                </li>
                                <li class="">
                                    <a  href="{{ route('enfantsb-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export E.Tiers</a>
                                </li>
                                <li class="">
                                    <a  href="/form-import"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export users</a>
                                </li>
                             
                       
                         @endif
                    </ul>
                @endif
       
                    
                </div>
                <div class="col-md-9 p-2">
                    @yield('content')
                </div>
            </div>
            <div style="margin-top: 210px border-top">
                <ul class="text-center">
                    <li class="font-weight-bold link-info">
                        <a href="/download/guide.pdf"><i class="fas fa-download"></i> Téléchargement du GUIDE</a>
                    </li>
                </ul>
                    @php
                    use Carbon\Carbon;
                    $date = Carbon::now();
                    @endphp
                    <p class="small text-primary font-weight-bold   pt-2 text-center">
                        <i class="fa fa-copyright" aria-hidden="true"></i> Copyright 2021-04-30 - {{$date}}
                    </p>
                    <marquee class="text-primary font-weight-bold text-center" width="100%" direction="down" height="50px" scrollamount="1">
                        <img src="{{ asset('/images/logo.png') }}" width="50px" height="50px" alt=""> Société nationale industrielle et minière
                    </marquee>

            </div>
        </div>

    {{-- <footer class="p-4 fixed-bottom" style="margin-bottom:0px">
        <div class="container border">
            @php
            use Carbon\Carbon;
            $date = Carbon::now();
            @endphp
            <p class="small text-primary font-weight-bold text-center  pt-2">
                <i class="fa fa-copyright" aria-hidden="true"></i> Copyright {{$date}}
            </p>
            <p class="text-primary text-center">Société nationale industrielle et minière</p>
        </div>
    </footer> --}}

    <!-- </body></html><script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script> -->
    <script src="{{ asset('js/all.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/brands.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/conflict-detection.min.js"></script> -->
    <script src="{{ asset('js/brands.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/fontawesome.min.js"></script> -->
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/regular.min.js"></script> -->
    {{-- <script src="{{ asset('js/') }}"></script> --}}
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/solid.min.js"></script> -->
    <script src="{{ asset('js/solid.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/v4-shims.min.js"></script> -->
    <script src="{{ asset('js/v4-shims.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script> --}}
    <script src="{{ asset('js/bootstrap-table.js') }}"></script>
    <!-- <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script> -->
    <script src="{{ asset('js/tableExport.min.js') }}"></script>
    <!-- <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table-locale-all.min.js"></script> -->
    <script src="{{ asset('js/bootstrap-table-locale-all.min.js') }}"></script>
    <!-- <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/extensions/export/bootstrap-table-export.min.js"></script> -->
    <script src="{{ asset('js/bootstrap-table-export.min.js') }}"></script>



    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        var i = 0;
        $("#add-btnC").click(function(){
        ++i;
        $("#dynamicAddRemoveC").append('<tr><td><input value="{{old("moreFieldsC['+i+'][nni]")}}" maxlength="10" type="text" name="moreFieldsC['+i+'][nni]" placeholder="Enter nni" class="form-control" /></td><td><input value="{{old("moreFieldsC['+i+'][nom]")}}" type="text" name="moreFieldsC['+i+'][nom]" placeholder="Enter nom" class="form-control" /></td><td><input value="{{old("moreFieldsC['+i+'][prenom]")}}" type="text" name="moreFieldsC['+i+'][prenom]" placeholder="Enter prénom" class="form-control" /></td><td><select  name="moreFieldsC['+i+'][statut]"  class="form-control"><option {{ old("moreFieldsC['+i+'][statut]") == "1" ? "selected" : "" }} value="1">assuré</option><option {{ old("moreFieldsC['+i+'][statut]") == "0" ? "selected" : "" }} value="0">non assuré</option></select></td><td><input style="width: 125px"  type="text" name="moreFieldsC['+i+'][num_cnam]" placeholder="Enter num_cnam" class="form-control" value="{{ old('num_cnam') }}"/></td><td><input required="required"  type="date" name="moreFieldsC['+i+'][date_naissance]" value="{{ old("moreFieldsC['+ i +'][date_naissance]") }}" class="form-control" /></td><td><input required="required"  type="date" name="moreFieldsC['+i+'][date_mariage]" value="{{ old("moreFieldsC['+ i +'][date_mariage]") }}" class="form-control" /></td><td><input required="required" type="file" name="moreFieldsC['+i+'][couple_image]" class="form-control" value=""/></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
        $("#add-btnC").attr("disabled", true);
        });

        $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
        $("#add-btnC").attr("disabled", false);
        });

        var j = 0;
        $("#add-btnE").click(function(){
        j++;
        $("#dynamicAddRemoveE").append('<tr><td><input value="{{old("moreFieldsE['+j+'][nni]")}}" maxlength="10" required="required" type="text" name="moreFieldsE['+j+'][nni]" placeholder="Enter nni" class="form-control" /></td><td><input value="{{old("moreFieldsE['+j+'][nom]")}}" required="required" type="text" name="moreFieldsE['+j+'][nom]" placeholder="Enter nom" class="form-control" /></td><td><input value="{{old("moreFieldsE['+j+'][prenom]")}}" required="required" type="text" name="moreFieldsE['+j+'][prenom]" placeholder="Enter prénom" class="form-control" /></td><td><select required="required"  name="moreFieldsE['+j+'][statut]"  class="form-control"><option {{ old("moreFieldsE['+j+'][statut]") == "1" ? "selected" : "" }} value="1">assuré</option><option {{ old("moreFieldsE['+j+'][statut]") == "0" ? "selected" : "" }} value="0">non assuré</option></select></td><td><select required="required"  name="moreFieldsE['+j+'][scolarite]"  class="form-control"><option {{ old("moreFieldsE['+j+'][scolarite]") == "1" ? "selected" : "" }} value="1">scolarisé</option><option {{ old("moreFieldsE['+j+'][scolarite]") == "0" ? "selected" : "" }} value="0">non scolarisé</option></select></td><td><select required="required" name="moreFieldsE['+j+'][sexe]" class="form-control"><option {{ old("moreFieldsE['+j+'][sexe]") == "masculin" ? "selected" : "" }} vlaue="maculin">masculin</option><option {{ old("moreFieldsE['+j+'][sexe]") == "feminin" ? "selected" : "" }} vlaue="feminin">féminin</option></select></td><td><input style="width: 125px"  type="text" name="moreFieldsE['+j+'][num_cnam]" placeholder="Enter num_cnam" class="form-control" value="{{ old('num_cnam') }}"/></td><td><input required="required"  type="date" name="moreFieldsE['+j+'][date_naissance]" value="{{ old("moreFieldsE['+ j +'][date_naissance]") }}" class="form-control" /></td><td><input required="required" type="file" name="moreFieldsE['+j+'][e_image]" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
        });

        $(function() {
           $("input[name='genre']").click(function() {
             if ($("#chkYes").is(":checked")) {
               $("#dvPinNo").show();
             } else {
               $("#dvPinNo").hide();
             }
           });

        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(".loader").fadeOut("slow");

            $('[data-toggle="tooltip"]').tooltip();

         });


           $('.selectemp_mat').select2({
            placeholder: 'Select an option'
            });

           $('.selectemp_nni').select2({
            placeholder: 'Select an option'
            });

           $('.selectemp_prenom').select2({
            placeholder: 'Select an option'
            });
           $('.selectemp').select2({
            placeholder: 'Select an option'
            });

</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="REGISTRE DE LABORATOIRE PTS VERSION ELECTRONIQUE">
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

.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 90%;
	height: 90%;
	z-index: 9999;
	background: url("{{ asset('images/loader6.gif') }}") center no-repeat #fff;
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
                {{ config('', '') }} <span class="text-center" style="font-size: 10px">(REGISTRES DE LABORATOIRE PTS VERSION ELECTRONIQUE)</span></br><span class="text-center" style="direction:rtl; margin-left:5px; font-family: 'Tajawal', sans-serif; font-size: 22px">    سجلات مختبر الشرطة الفنية والعلمية النسخة الرقمية </span>
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
                            <i class="fas fa-user-circle opacity-8 text-dark me-2" style="color:#3A82E3"></i>
                            {{ Auth::user()->name  }}<span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('users.edit', ['user'=>$user_id]) }}">
                                <i class="fa fa-edit" style="color:#3A82E3"></i>
                                    Modifier profile
                               </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();"><i class="fa fa-power-off" style="color:#d61212"></i>
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
                Bienvenue au nouveau Site Intranet Automatisation des Registres de Laboratoire PTS  <img src="{{ asset('/images/logo.jpeg') }}" width="25px" height="25px" alt="">.
            </marquee>
        </div>
        </div>
    </header>
        <div class="container border">
        <div class="row">
                <div class="col-md-3 p-2">
                @if ($user->profile == 'profil2'||$user->profile == 'profil3'||$user->profile == 'profil1')
                    <small class="text-center"><strong class="font-weight-bold text-primary">L.</strong> <strong class="text-info">: LISTE</strong></small>
                    <small class="text-center"><strong class="font-weight-bold text-primary">A.</strong> <strong class="text-info">: AJOUTER</strong></small>
                 @endif
                    <ul class=" border p-4">
                         <li class="">
                                <a class="" href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i>&nbsp;Accueil</a>
                            </li>



                        @if ($user->profile == 'profil3'||$user->profile == 'profil2'||$user->profile == 'profil1')
                        <li class="">
                            <a class="" href="{{ route('empone.create') }}"><i class="fas fa-plus-circle"></i> A.AffaireSimple </a>
                        </li>
                        <li class="">
                            <a class="" href="{{ route('employes.create') }}"><i class="fas fa-plus-circle"></i> A.AffaireComplet</a>
                        </li>
                       <li class="">
                            <a class=" active" href="{{ route('employes.index') }}"><i class="fas fa-list"></i>  L.Affaires</a>
                        </li>
						  
                       <li class="">
                            <a class=" active"  href="{{ route('search') }}"><i class="fas fa-list"></i>  L.AffairesPositives</a>
                        </li>

                      </ul>
                        @endif
                  
                    @if ($user->profile == 'profil2'|| $user->profile == 'profil3'||$user->profile == 'profil1')
                        <ul class=" border p-4">

                        <li class="">
                                <a class="" href="{{ route('commissariats.create') }}"><i class="fas fa-plus-circle"></i> A.ServiceDemendeur</a>
                            </li>

                            <li class="">
                                <a class=" active" href="{{ route('commissariats.index') }}"><i class="fas fa-list"></i>  L.ServicesDemendeurs</a>
                            </li>

                        @endif

                     </ul>       @if ($user->profile == 'profil2'|| $user->profile == 'profil3'||$user->profile == 'profil1')
                        <ul class=" border p-4">
                            <li class="">
                                <a class="" href="{{ route('rapports.create') }}"><i class="fas fa-plus-circle"></i> A.Rapport(s)</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('rapports.index') }}"><i class="fas fa-list"></i>  L.Rapport(s)</a>
                            </li>
						      @endif

                     </ul>     @if ($user->profile == 'profil2'|| $user->profile == 'profil3'||$user->profile == 'profil1')
                        <ul class=" border p-4">
					 
					       <li class="">
                                <a class="" href="{{ route('intervenants.create') }}"><i class="fas fa-plus-circle"></i> A.Intervenant</a>
                            </li>	      @endif

                     </ul>
					 
					 
					   @if ($user->profile == 'profil2'|| $user->profile == 'profil3'||$user->profile == 'profil1')
                        <ul class=" border p-4">
					 
					 
							 <li class="">
                                <a class="" href="{{ route('echantillons.create') }}"><i class="fas fa-plus-circle"></i> A.Echantillon</a>
                            </li>
							 <li class="">
                                <a class=" active" href="{{ route('echantillons.index') }}"><i class="fas fa-list"></i> L.Echantillons</a>
                            </li>
                           @endif

                     </ul>
						  
						     @if ($user->profile == 'profil2'|| $user->profile == 'profil3'||$user->profile == 'profil1')
                        <ul class=" border p-4">
							 <li class="">
                                <a class="" href="{{ route('reste_scelle.create') }}"><i class="fas fa-plus-circle"></i> A.R-Scellé</a>
                            </li>
                            <li class="">
                                <a class=" active" href="{{ route('reste_scelle.index') }}"><i class="fas fa-list"></i>  L.Restes-Scellé</a>
                            </li>

                        @endif

                     </ul>
					 
					         
                    @if ($user->profile == 'profil2'|| $user->profile == 'profil3'||$user->profile == 'profil1')
                        <ul class=" border p-4">
					 
					 	 <li class="">
                                <a class="" href="{{ route('genetic-profiles.create') }}"><i class="fas fa-plus-circle"></i> A.ProfilGénétique</a>
                            </li>
							 <li class="">
                                <a class=" active" href="{{ route('genetic-profiles.index') }}"><i class="fas fa-list"></i> L.ProfilsGénétiques</a>
                            </li>
                            <li>
                                 <a class="active" href="{{ route('genetic_profiles.search') }}"><i class="fas fa-search"></i> Personne</a>
                            </li>

					 	 <li class="">
                                <a class=" active" href="{{ route('genetic_markers.search') }}"><i class="fas fa-search"></i> ProfilADN-Autosome</a>
                            </li>
					 
                        @endif
                     </ul>
					 
					 
					 
					 
					 
					 
					 
					 


                    @if ( $user->profile == 'profil3'||$user->profile == 'profil2'||$user->profile == 'profil1')
                        <ul class=" border p-4">
                        @if ($user->profile == 'profil3'||$user->profile == 'profil2'||$user->profile == 'profil1')
                        <li class="">
                            <a  href="{{ route('users.index') }}"><i class="fas fa-users"></i> L.Utilisateurs</a>
                        </li>
                        @if ($user->profile == 'profil3'&& ($user->name == 'dev'))
                        <li class="">
                            <a  href="{{ route('users.create') }}"><i class="fas fa-plus-circle"></i> A.Utilisateur</a>
                        </li>  
                        <li class="">
                            <a  href="{{ route('logs.index') }}"><i class="fas fa-list"></i> Logs</a>
                        </li>
						 @endif
                        @endif
                        </ul>
                    @endif
                @if ( $user->profile == 'profil3'||$user->profile == 'profil2'||$user->profile == 'profil1')
                    <ul class="border p-4">
                        @if ($user->profile == 'profil3'||$user->profile == 'profil2'||$user->profile == 'profil1')
                                <li class="">
                                    <a  href="{{ route('employes-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export AFF</a>
                                </li>
                                <li class="">
                                    <a  href="{{ route('couples-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Im|Export SD</a>
                                </li>
                                <li class="">
                                    <a  href="{{ route('enfantsb-import-form') }}"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Im|Export RS</a>
                                </li>
                                 <li class="">
                                    <a  href="/form-import"><i class="fas fa-file-import fa-spin" style="font-size:15px"></i> Import|Export Users</a>
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
                        <a href="/files/guide.pdf"><i class="fas fa-download"></i> Téléchargement du GUIDE</a>
                    </li>
                </ul>
                    @php
                    use Carbon\Carbon;
                    $date = Carbon::now();
                    @endphp
                    <p class="small text-primary font-weight-bold   pt-2 text-center">
                        <i class="fa fa-copyright" aria-hidden="true"></i> Copyright 2023-02-17 - {{$date}}
                    </p>
                    <marquee class="text-primary font-weight-bold text-center" width="100%" direction="down" height="80px" scrollamount="1">
                        <img src="{{ asset('/images/logo.jpeg') }}" width="50px" height="50px" alt=""> مختبر الشرطة الفنية والعلمية
                    </marquee>

            </div>
        </div>



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
        $("#dynamicAddRemoveC").append('<tr><td><input value="{{old("moreFieldsC['+i+'][nom]")}}" type="text" name="moreFieldsC['+i+'][nom]" placeholder="Entrer nom" class="form-control" /></td><td><input value="{{old("moreFieldsC['+i+'][prenom]")}}" type="text" name="moreFieldsC['+i+'][prenom]" placeholder="Entrer prénom" class="form-control" /></td><td><input value="{{old("moreFieldsC['+i+'][matricule]")}}" type="text" name="moreFieldsC['+i+'][matricule]" placeholder="Entrer matricule" class="form-control" /></td> <td><input value="{{old("moreFieldsC['+i+'][grade]")}}" type="text" name="moreFieldsC['+i+'][grade]" placeholder="Entrer grade" class="form-control" /></td><td><input required="required"  type="date" name="moreFieldsC['+i+'][date_intervention]" value="{{ old("moreFieldsC['+ i +'][date_intervention]") }}" class="form-control" /></td><td><input required="required" type="file" name="moreFieldsC['+i+'][e_image]" class="form-control" value=""/></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
        });

        var j = 0;
        $("#add-btnE").click(function(){
        j++;
        $("#dynamicAddRemoveE").append('<tr><td><input value="{{old("moreFieldsE['+j+'][num_echantillon]")}}" type="text" required="required" name="moreFieldsE['+j+'][num_echantillon]" placeholder="Entrer N°echantillon" class="form-control"/></td><td><input value="{{old("moreFieldsE['+j+'][num_scelle]")}}" type="text" name="moreFieldsE['+j+'][num_scelle]" placeholder="Entrer N°Scelle" class="form-control"/></td><td><input value="{{old("moreFieldsE['+j+'][description]")}}" type="text" required="required" name="moreFieldsE['+j+'][description]" placeholder="Entrer Déscription" class="form-control"/></td><td><select required="required"  name="moreFieldsE['+j+'][etat]"  class="form-control"><option value="Conforme">Conforme</option><option value="NonConforme">NonConforme</option> </select></td><td><input  type="txt" name="moreFieldsE['+j+'][periode_conservation]" value="{{ old("moreFieldsE['+ j +'][periode_conservation]") }}"  placeholder="Entrer periode conservation" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
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

<!-- jQuery 3 -->

</body>
</html>

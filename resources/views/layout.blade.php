<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body{
            font-family: 'Roboto Mono', monospace;
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
        /* background-color:rgb(255,0,0);opacity:0.6; */
        background-color: hsla(120, 100%, 50%, 0.3);
        left: 0.7em;
        right: 0.7em;
        height: 1.2em;
        text-align: center;
        }
        .nonAssure {
        position: relative;
        /* background-color:rgb(255,0,0);opacity:0.6; */
        background-color: hsla(9, 87%, 56%, 0.5);
        left: 0.7em;
        right: 0.7em;
        height: 1.2em;
        text-align: center;
        }

        ul {
        list-style-type: none;
        margin: 0;
        padding: 2px;
        }
    </style>
</head>
<body>
    @php
        $user_id = auth()->user()->id;
        $user = \App\User::where(['id' => $user_id])->first();  
    @endphp
    <div id="app">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm" style="color:white">
                <div class="container">
                    <a style="color:white" class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
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
                                    {{ Auth::user()->name }}
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>
                                    {{-- <a class="dropdown-item" href="{{ route('users.edit', ['user'=>$user_id]) }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Modifier Profile
                                    </a> --}}
                                    
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
            
        </div>
        </div>
    <div class="mt-4 mb-4">
        <div class="container border">
            {{-- <h4 class="font-weight-bold text-success text-center">Application de gestion des carnets familliaux</h4> --}}
            <div class="row">
                <div class="col-md-3">
                    <ul class=" border">
                        @if ($user->profile == 'profil1')
                            <li class="">
                                <a class="" href="{{ route('search') }}">Chercher</a>
                            </li>
                            <li class="">
                                <a class=" active" href="{{ route('employes.index') }}">Liste Livrets</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil2')
                            <li class="">
                                <a class="" href="{{ route('search') }}">Chercher</a>
                            </li>
                            <li class="">
                                <a class=" active" href="{{ route('employes.index') }}">Liste Livrets</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('employes.create') }}">Créer une livret</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('empone.create') }}">Ajouter Employé</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil3')
                        <li class="">
                            <a class="" href="{{ route('search') }}">Chercher</a>
                        </li>
                        <li class="">
                            <a class=" active" href="{{ route('employes.index') }}">Liste Livrets</a>
                        </li>
                        <li class="">
                            <a class="" href="{{ route('employes.create') }}">Créer une livret</a>
                        </li>
                        <li class="">
                            <a class="" href="{{ route('empone.create') }}">Ajouter Employé</a>
                        </li>
                        @endif
                        
                        
                        
                    </ul>
                    <ul class=" border">
                        @if ($user->profile == 'profil1')
                            <li class="">
                                <a class=" active" href="{{ route('couples.index') }}">Liste Conjointes</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil2')
                            <li class="">
                                <a class=" active" href="{{ route('couples.index') }}">Liste Conjointes</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('couples.create') }}">Ajouter Conjointe</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil3')
                            <li class="">
                                <a class=" active" href="{{ route('couples.index') }}">Liste Conjointes</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('couples.create') }}">Ajouter Conjointe</a>
                            </li>
                        @endif
                        
                    </ul>
                    <ul class=" border">
                        @if ($user->profile == 'profil1')
                            <li class="">
                                <a class="" href="{{ route('enfants.index') }}">Liste Enfants</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil2')
                            <li class="">
                                <a class="" href="{{ route('enfants.index') }}">Liste Enfants</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfants.create') }}">Ajouter Enfant</a>
                            </li>
                        @endif
                        @if ($user->profile == 'profil3')
                            <li class="">
                                <a class="" href="{{ route('enfants.create') }}">Ajouter Enfant</a>
                            </li>
                            <li class="">
                                <a class="" href="{{ route('enfants.index') }}">Liste Enfants</a>
                            </li>
                        @endif
                    </ul>
                    <ul class=" border">
                        @if ($user->profile == 'profil1')
                            
                        @endif
                        @if ($user->profile == 'profil2')
                            
                        @endif
                        @if ($user->profile == 'profil3')
                            <li class="">
                                <a  href="{{ route('users.create') }}">Ajouter user</a>
                            </li>
                            <li class="">
                                <a  href="{{ route('users.index') }}">users</a>
                            </li>
                            <li class="">
                                <a  href="{{ route('logs.index') }}">logs</a>
                            </li>
                        @endif
                        
                    </ul>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    {{-- <footer class="fixed-bottom" style="margin-top: 100px">
        @php 
            use Carbon\Carbon;
            $date = Carbon::now();
        @endphp
        <p class="small text-secondary text-center border-top pt-2 mt-4">
            <i class="fa fa-copyright" aria-hidden="true"></i> Copyright {{$date}}
        </p>
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
    <script src="{{ asset('js/') }}"></script>
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js" integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw==" crossorigin="anonymous"></script> --}}
    {{-- <script src="{{ asset('js/selectize.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        var i = 0;
        $("#add-btnC").click(function(){
        ++i;
        $("#dynamicAddRemoveC").append('<tr><td><input value="{{old("moreFieldsC['+i+'][nni]")}}" maxlength="10" type="text" name="moreFieldsC['+i+'][nni]" placeholder="Enter nni" class="form-control" /></td><td><input value="{{old("moreFieldsC['+i+'][nom]")}}" type="text" name="moreFieldsC['+i+'][nom]" placeholder="Enter nom" class="form-control" /></td><td><input value="{{old("moreFieldsC['+i+'][prenom]")}}" type="text" name="moreFieldsC['+i+'][prenom]" placeholder="Enter prénom" class="form-control" /></td><td><select  name="moreFieldsC['+i+'][statut]"  class="form-control"><option {{ old("moreFieldsC['+i+'][statut]") == "1" ? "selected" : "" }} value="1">assuré</option><option {{ old("moreFieldsC['+i+'][statut]") == "0" ? "selected" : "" }} value="0">non assuré</option></select></td><td><select name="moreFieldsC['+i+'][sexe]" class="form-control"><option {{ old("moreFieldsC['+i+'][sexe]") == "masculin" ? "selected" : "" }} value="masculin">masculin</option><option {{ old("moreFieldsC['+i+'][sexe]") == "feminin" ? "selected" : "" }} value="feminin">féminin</option></select></td> <td><input required="required"  type="date" name="moreFieldsC['+i+'][date_naissance]" value="{{ old("moreFieldsC['+ i +'][date_naissance]") }}" class="form-control" /></td><td><input required="required"  type="date" name="moreFieldsC['+i+'][date_mariage]" value="{{ old("moreFieldsC['+ i +'][date_mariage]") }}" class="form-control" /></td><td><input required="required" type="file" name="moreFieldsC['+i+'][couple_image]" class="form-control" value=""/></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
        $("#add-btnC").attr("disabled", true);
        });

        $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
        $("#add-btnC").attr("disabled", false);
        });

        var j = 0;
        $("#add-btnE").click(function(){
        j++;
        $("#dynamicAddRemoveE").append('<tr><td><input value="{{old("moreFieldsE['+j+'][nni]")}}" maxlength="10" required="required" type="text" name="moreFieldsE['+j+'][nni]" placeholder="Enter nni" class="form-control" /></td><td><input value="{{old("moreFieldsE['+j+'][nom]")}}" required="required" type="text" name="moreFieldsE['+j+'][nom]" placeholder="Enter nom" class="form-control" /></td><td><input value="{{old("moreFieldsE['+j+'][prenom]")}}" required="required" type="text" name="moreFieldsE['+j+'][prenom]" placeholder="Enter prénom" class="form-control" /></td><td><select required="required"  name="moreFieldsE['+j+'][statut]"  class="form-control"><option {{ old("moreFieldsE['+j+'][statut]") == "1" ? "selected" : "" }} value="1">assuré</option><option {{ old("moreFieldsE['+j+'][statut]") == "0" ? "selected" : "" }} value="0">non assuré</option></select></td><td><select required="required"  name="moreFieldsE['+j+'][scolarite]"  class="form-control"><option {{ old("moreFieldsE['+j+'][scolarite]") == "1" ? "selected" : "" }} value="1">scolarisé</option><option {{ old("moreFieldsE['+j+'][scolarite]") == "0" ? "selected" : "" }} value="0">non scolarisé</option></select></td><td><select required="required" name="moreFieldsE['+j+'][sexe]" class="form-control"><option {{ old("moreFieldsE['+j+'][sexe]") == "masculin" ? "selected" : "" }} vlaue="maculin">masculin</option><option {{ old("moreFieldsE['+j+'][sexe]") == "feminin" ? "selected" : "" }} vlaue="feminin">féminin</option></select></td><td><input required="required"  type="date" name="moreFieldsE['+j+'][date_naissance]" value="{{ old("moreFieldsE['+ j +'][date_naissance]") }}" class="form-control" /></td><td><input required="required" type="file" name="moreFieldsE['+j+'][e_image]" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash-alt"></i></button></td></tr>');
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

          
         });


           $('.selectemp').select2({
            placeholder: 'Select an option'
            });
         
                
</script>

</body>
</html>

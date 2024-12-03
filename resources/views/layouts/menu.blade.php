<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion De Projets</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('Admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('Admin/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('Admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('Admin/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Admin/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('Admin/dist/css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js does')}}n't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>GP</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Gestion De Projet</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                     
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Connexion</a></li>
                            <li><a href="{{ route('register') }}">Inscription</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="glyphicon glyphicon-user"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li >
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
                                            Déconnexion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                  

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">

                <li class="{{ Request::is('home') ? 'active' : '' }}">
                    <a href="/home">
                        <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
                    </a>

                </li>

              @if (Auth::user()->role==='admin')
                <li  class="{{ Request::is('categorie*') ? 'active' : '' }}">
                   <a href="/categorie" >
                        <i class="fa fa-th-large"></i>
                        <span>Catégories</span>

                    </a>

                </li>
                @endif
                @if (Auth::user()->role==='admin')

                 <li  class="{{ Request::is('client*') ? 'active' : '' }}">
                    <a href="/client" >
                    
                        <i class="fa fa-user"></i>
                        <span>Clients</span>

                    </a>

                </li>
               
                 
                @endif

              
              
                  @if  ((Auth::user()->role==='admin')
                ||(Auth::user()->role==='responsable'))

              <li  class="{{ Request::is('projet*') ? 'active' : '' }}">
                    <a href="/projet" >
                    
                        <i class="fa fa-pencil-square-o"></i>
                        <span>Projet</span>

                    </a>

                </li>

                 @endif

                   
                       
                     @if  (Auth::user()->role==='admin')
                        <li  class="{{ Request::is('facture*') ? 'active' : '' }}">
                        <a href="/facture"><i class="fa fa-money"></i> Factures</a></li>

                        <li  class="{{ Request::is('devis*') ? 'active' : '' }}">
                        <a href="/devis"><i class="fa fa-calendar-check-o"></i> Devis</a></li>
                        @endif

                   
             

           
                 @if (Auth::user()->role==='admin')
               <li  class="{{ Request::is('employe*') ? 'active' : '' }}">
                    <a href="/employe">
                        <i class="fa fa-group"></i> <span>Employés</span>

                    </a>
                </li>
                @endif
                  


            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

     @yield('content')

    
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('Admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('Admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('Admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('Admin/bower_components/chart.js/Chart.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('Admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('Admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('Admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('Admin/dist/js/demo.js')}}"></script>
<!-- page script -->
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
</body>
</html>

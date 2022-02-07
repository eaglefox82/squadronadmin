<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/material-dashboard.css') }}">
</head>
<body class="">
<div class="wrapper">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('img/sidebar-1.jpg') }}">
        <div class="logo">
            <a href="#" class="simple-text logo-normal text-center">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="{{ asset('storage/avatar/'.Auth::user()->avatar) }}" alt="">
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" href="#collapseExample" class="username">
                      <span>
                          @guest

                          @else
                              {{ Auth::user()->firstname }} {{Auth::user()->lastname}}
                          @endguest
                        <b class="caret"></b>
                      </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="#">--}}
                                    {{--<span class="sidebar-mini"> S </span>--}}
                                    {{--<span class="sidebar-normal"> Settings </span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{action('UsersController@show', Auth::user()->id)}}">
                                    <span class="sidebar-mini"> P </span>
                                    <span class="sidebar-normal"> User Profile </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="sidebar-mini"> L </span>
                                    <span class="sidebar-normal"> Logout </span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
               <li class="nav-item">
                  <a class="nav-link" href="{{action('HomeController@index')}}">
                       <i class="material-icons">dashboard</i>
                       <p> Dashboard </p>
                   </a>
               </li>
               <li class="nav-item ">
                   <a class="nav-link" href="{{action('MembersController@index')}}">
                       <i class="fa fa-users"></i>
                       <p> Members </p>
                   </a>
               </li>

               <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href="#roll">
                    <i class="fa fa-book"></i>
                        <p>Rolls
                            <b class = "caret"></b>
                        </p>
                </a>
                <div class = "collapse" id="roll">
                    <ul class = "nav">

                       <li class = "nav-item">
                           <a class = "nav-link"  href="{{action('RollController@index')}}">
                            <span class= "sidebar-normal">Current Roll</span>
                           </a>
                        </li>

                        <li class = "nav-item">
                            <a class = "nav-link" href = "{{action('RollController@parade')}}">
                                <span class = "sidebar-normal">First Parade Roll</span>
                            </a>
                        </li>

                        <li class = "nav-item">
                            <a class = "nav-link" href={{action('RollController@show', [1])}}>
                                <span class = "sidebar-normal">Past Rolls</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href="#events">
                    <i class="fa fa-ticket"></i>
                        <p>Squadron Events
                            <b class = "caret"></b>
                        </p>
                </a>
                <div class = "collapse" id="events">
                    <ul class = "nav">

                       <li class = "nav-item">
                           <a class = "nav-link"  href="{{action('EventController@index')}}">
                            <span class= "sidebar-normal">Event List</span>
                           </a>
                        </li>

                        <li class = "nav-item">
                            <a class = "nav-link" href = "{{action('EventController@index')}}">
                                <span class = "sidebar-normal">Event Rolls</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class = "nav-link" data-toggle = "collapse" href="#accounting">
                    <i class="fa fa-money"></i>
                    <p>Squadron Accounting
                        <b class = "caret"></b>
                    </p>
                </a>
                <div class = "collapse" id="accounting">
                    <ul class = 'nav'>

                        <li class = "nav-item">
                            <a class = "nav-link" href ="{{action('SquadronAccountingController@index')}}">
                                <span class = "sidebar-normal">Sqaudron Accounting Overview</span>
                            </a>
                        </li>

                        <li class = "nav-item">
                            <a class = "nav-link" href="{{action('ActiveKidsController@index')}}">
                                <span class = "sidebar-normal">Vouchers</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

               <li class="nav-item">
                   <a class = "nav-link" data-toggle = "collapse" href="#reports">
                       <i class="fa fa-paperclip"></i>
                        <p>Reports
                            <b class = "caret"></b>
                        </p>
                   </a>

                   <div class = "collapse" id="reports">
                        <ul class = "nav">

                            <li class="nav-item ">
                                <a class="nav-link" href="{{action('Form19Controller@index')}}">
                                    <span>Form 19</span>
                                </a>
                            </li>

                        </li>

                        @if(config('global.Squadron_Points') != 'N')
                            <li class="nav-item">
                                <a class="nav-link" href="{{action('PointsController@index')}}">
                                    <span>Squadron Points</span>
                                </a>
                            <li>
                        @endif


                            <li class="nav-item">
                                <a class="nav-link" href="{{action('ReportController@attendance')}}">
                                    <span>Attendance Overview</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{action('StockController@index')}}">
                                    <span>Stock List</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{action('ReportController@past')}}">
                                    <span>Saved Reports</span>
                                </a>
                            </li>

                        </ul>
                    </div>



                </li>


               <!-- Drop down other menu -->
                <li class = "nav-item">
                    <a class = "nav-link" data-toggle = "collapse" href="#others">
                        <i class="fa fa-cog"></i>
                            <p>Other Items
                                <b class = "caret"></b>
                            </p>
                    </a>
                    <div class = "collapse" id="others">
                        <ul class = "nav">

                           <li class = "nav-item">
                               <a class = "nav-link"  href="{{action('SettingsController@index')}}">
                                <span class= "sidebar-normal">Squadron Settings</span>
                               </a>
                            </li>

                            <li class = "nav-item">
                                <a class = "nav-link" href = "https://admin.airleague.com.au/" target="_blank">
                                    <span class = "sidebar-normal">NAS</span>
                                </a>
                            </li>

                            <li class = "nav-item">
                                <a class = "nav-link" href="//www.mailchimp.com" target="_blank">
                                    <span class = "sidebar-normal">Mailchimp</span>
                                </a>
                            </li>

                            <li class = "nav-item">
                                <a class = "nav-link" href="https://nsw.airleague.com.au/submit/nsw-voucher/" target="_blank">
                                    <span class = "sidebar-normal">NSW Vouchers</span>
                                </a>
                            </li>

                            <li class = "nav-item">
                                <a class = "nav-link" href="https://github.com/eaglefox82/squadronadmin/releases" target="_blank">
                                    <span class = "sidebar-normal">Release Notes</span>
                                </a>
                            </li>

                        </ul>
                    </div>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    {{--<a class="navbar-brand" href="#">Dashboard</a>--}}
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->

        <h2 class="text-center">{{  config('app.name', 'Squadron') }} Admin Site
            @if (App::environment() != 'Production')
                - Development
            @endif
        </h2>

        <div class="content">
            @yield('content')
        </div>

        <footer class="footer ">
            <div class="container">
                <div class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                     | Devlopment by Brendan Fox</a>
                </div>
            </div>
        </footer>
    </div>
</div>
@stack('scripts')
</body>
<!--   Core JS Files   -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>




<script src="{{ asset('js/core/jquery.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-material-design.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
<script src="{{ asset('js/plugins/moment.min.js') }}"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="{{ asset('js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('js/plugins/nouislider.min.js') }}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('js/plugins/bootstrap-selectpicker.js') }}"></script>
<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/  -->
<script src="{{ asset('js/plugins/bootstrap-tagsinput.js') }}"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}"></script>
<!-- Plugins for presentation and navigation  -->
<script src="{{ asset('js/modernizr.js') }}"></script>
<!-- Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="{{ asset('js/material-dashboard.js?v=2.0.1') }}"></script>
<!-- Dashboard scripts -->
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('js/plugins/arrive.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="{{ asset('js/plugins/chartist.min.js') }}"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('js/plugins/jquery.bootstrap-wizard.js') }}"></script>
<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('js/plugins/jquery-jvectormap.js') }}"></script>
<!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
<script src="{{ asset('js/plugins/nouislider.min.js') }}"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('js/plugins/jquery.select-bootstrap.js') }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{ asset('js/plugins/jquery.datatables.js') }}"></script>
<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="{{ asset('js/plugins/sweetalert2.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('js/plugins/fullcalendar.min.js') }}"></script>

@yield('scripts')

</html>

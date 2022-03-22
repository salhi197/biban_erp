
<!doctype html>
<html lang="en" dir="ltr">
	
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta content="Solic – Bootstrap Responsive Modern Simple Dashboard Clean HTML Premium Admin Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="html5 template, admin panel html template,  html5 admin template, admin panel html, admin panel html template, html css admin templates, dashboard html5, html dashboard template, simple dashboard html template, html5 dashboard template, dashboard html5,  simple dashboard html, dashboard design template, bootstrap 4 admin template,  bootstrap admin template,  admin, premium admin templates, best bootstrap admin template, bootstrap dashboard template,   admin ui templates, modern admin template, admin panel template bootstrap 4"   />
    <!--favicon -->
    <link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
<!-- TITLE -->
    <title>Biban Fret</title>
    <!-- DASHBOARD CSS -->
    <link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/dashboard-dark.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/style-modes.css')}}" rel="stylesheet"/>
    <!-- HORIZONTAL-MENU CSS -->
    <link href="{{asset('assets/plugins/horizontal-menu/dropdown-effects/fade-down.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/horizontal-menu/horizontal-menu.css')}}" rel="stylesheet">
    <!--C3.JS CHARTS PLUGIN -->
    <link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet"/>
    <!-- Data table css -->
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}">
    <link href="{{asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- PERFECT SCROLL BAR CSS-->
<!-- <link href="{{asset('assets/plugins/pscrollbar/perfect-scrollbar.css')}}" rel="stylesheet" /> -->
<!--- FONT-ICONS CSS -->
<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet"/>
<!-- SELECT2 CSS -->
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
<!-- Skin css-->
<link href="{{asset('assets/skins/skins-modes/color10.css')}}"  id="theme" rel="stylesheet" type="text/css" media="all" />
<!-- SIDEBAR CSS -->
<link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

@yield('header-script')
@yield('styles')
<!-- Switcher CSS -->
<link href="{{asset('assets/switcher/css/switcher.css')}}" rel="stylesheet">
<link href="{{asset('assets/switcher/demo.css')}}" rel="stylesheet">	</head>
	<body class="default-header">
		<!-- Switcher -->
		<div class="switcher-wrapper">
		<!-- Switcher -->
		
		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('assets/images/svgs/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<div class="page">
			<div class="page-main">


<div class="header hor-top-header">
    <div class="container">
        <div class="d-flex">
            <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
            <a class="header-brand" href="index.html">
                <img src="{{asset('img/logo-biban.png')}}" class="header-brand-img desktop-logo" alt="BibanFret" /> 
                <img src="{{asset('img/logo-biban.png')}}" class="header-brand-img mobile-view-logo" alt="BibanFret" />
            </a>
            <!-- LOGO -->
            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="fa fa-search"></i></a>
            <div class="">
                <form class="form-inline">
                    <div class="search-element">
                        <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1" /> <button class="btn btn-primary-color" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <!-- SEARCH -->
            <a class="header-brand header-brand2" href="index.html">
                <img src="{{asset('img/logo-biban.png')}}" class="header-brand-img desktop-logo" alt="BibanFret" /> 
                <img src="{{asset('img/logo-biban.png')}}" class="header-brand-img mobile-view-logo" alt="BibanFret" />
            </a>
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
                <div class="dropdown d-md-flex">
                    <a class="nav-link icon full-screen-link nav-link-bg" id="fullscreen-button"> <i class="fe fe-maximize-2"></i> </a>
                </div>
                <!-- SIDE-MENU -->
                <!-- FULL-SCREEN -->
            </div>
        </div>
    </div>
</div>






				<!-- HEADER -->
<!-- HEADER END -->
				<!-- HORIZONTAL-MENU -->
				<div class="sticky">
					<div class="horizontal-main hor-menu clearfix">
						<div class="horizontal-mainwrapper container clearfix">
							<nav class="horizontalMenu clearfix">
								<ul class="horizontalMenu-list">
                                    <!-- <li aria-haspopup="true"><span class="horizontalMenu-click">
                                    <i class="horizontalMenu-arrow fa fa-angle-down"></i></span><a href="#" class="sub-icon"><i class="fe fe-pie-chart"></i> Prestataire  
                                        <i class="fa fa-angle-down horizontal-icon"></i></a> <ul class="sub-menu"> 
                                        <li aria-haspopup="true"><a href="{{route('client.index')}}">Programme</a></li> 
                                        <li aria-haspopup="true"><a href="{{route('immobilisation.index')}}"> Immobilisation</a></li> 
                                    </ul>
                                    </li> -->

                                    <li aria-haspopup="true"><a href="/home" class="sub-icon"><i class="fe fe-airplay"></i> Tableau de Bord </a></li>

                                    <li aria-haspopup="true"><a href="{{route('fournisseur.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Chauffeurs </a></li>
                                    


                                    <li aria-haspopup="true"><a href="{{route('sms.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Service Sms </a></li> 

                                    <li aria-haspopup="true"><a href="/user" class="sub-icon"><i class="fe fe-airplay"></i> Utilisateurs </a></li>


                                    <li aria-haspopup="true"><span class="horizontalMenu-click">
                                    <i class="horizontalMenu-arrow fa fa-angle-down"></i></span><a href="#" class="sub-icon"><i class="fe fe-pie-chart"></i> Options 
                                    <i class="fa fa-angle-down horizontal-icon"></i></a> <ul class="sub-menu"> 
                                        <li aria-haspopup="true"><a href="{{route('fichier.index')}}"> Historique</a></li> 
                                        <li aria-haspopup="true"><a href="{{route('fdr.index')}}"> Scan FDR</a></li> 
                                        <li aria-haspopup="true"><a href="{{route('decharge.index')}}"> Charges</a></li> 
                                        <li aria-haspopup="true"><a href="{{route('payment.index')}}"> Payments</a></li> 
                                        

                                    </ul>
                                    </li>



                                    <li aria-haspopup="true"><a href="/expire" class="sub-icon"><i class="fe fe-airplay"></i> Notifications </a></li>


                                    <li aria-haspopup="true"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="sub-icon"> 
                                    <i class="fe fe-pie-chart"></i> 
                                    Déconnexion                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                    </form>
                                    
                                     </a></li>

								</ul>
							</nav>
							<!-- NAV END -->
						</div>
					</div>
				</div>
			<!-- HORIZONTAL-MENU END -->            
				<!-- CONTAINER -->
				<div class="container-fluid content-area relative">
				<!-- PAGE-HEADER -->
                    @yield('content')
					<!-- PAGE-HEADER END -->
				<!-- ROW-1 OPEN -->
				</div>
				<!-- CONTAINER CLOSED -->
			</div>
@yield('modals')

	<footer class="footer">
		<div class="container">
			<div class="row align-items-center flex-row-reverse">
				<div class="col-md-12 col-sm-12 text-center">
					Copyright DzairSoft © {{date('Y')}} . 
				</div>
			</div>
		</div>
	</footer>
<!-- FOOTER END -->		</div><!-- End Page -->
			<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>
<!-- JQUERY SCRIPTS -->
<script src="{{asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="{{asset('assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
<!-- SPARKLINE -->
<script src="{{asset('assets/js/vendors/jquery.sparkline.min.js')}}"></script>
<!-- CHART-CIRCLE -->
<script src="{{asset('assets/js/vendors/circle-progress.min.js')}}"></script>
<!-- RATING STAR -->
<script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<!-- HORIZONTAL-MENU -->
<script src="{{asset('assets/plugins/horizontal-menu/horizontal-menu.js')}}"></script>
<!-- PERFECT SCROLL BAR JS-->
<!-- <script src="{{asset('assets/plugins/pscrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/pscrollbar/pscroll-1.js')}}"></script> -->
<!-- SIDEBAR JS -->
<script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>
<!-- SELECT2 JS -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<!-- C3.JS CHART PLUGIN -->
<script src="{{asset('assets/plugins/charts-c3/d3.v5.min.js')}}"></script>
<script src="{{asset('assets/plugins/charts-c3/c3-chart.js')}}"></script>
<!-- INPUT MASK PLUGIN-->
<script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>
<!-- DATA TABLE -->
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/datatable.js')}}"></script>
<!-- STICKY JS -->
<script src="{{asset('assets/js/stiky.js')}}"></script>
<!-- CUSTOM JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>

<!-- Switcher JS -->
<script src="{{asset('assets/switcher/js/switcher.js')}}"></script>	
<script src="{{asset('js/toastr.min.js')}}"></script>	
    <script>
    @if(session('success'))
        $(function(){
            toastr.success('{{Session::get("success")}}')
        })
    @endif

    @if(session('error'))
        $(function(){
            toastr.error('{{Session::get("error")}}')
        })
    @endif

    </script>

<script src="{{asset('js/dynamic-form.js')}}"></script>

@yield('scripts')

	</body>

<!-- Mirrored from laravel.spruko.com/solic/Horizontal-Light-ltr/datatable by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Sep 2020 16:42:22 GMT -->
</html>
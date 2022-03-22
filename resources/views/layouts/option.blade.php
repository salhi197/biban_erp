
<!doctype html>
<html lang="en" dir="ltr">
	
<!-- Mirrored from laravel.spruko.com/solic/Horizontal-Light-ltr/datatable by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Sep 2020 16:42:11 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
		<!-- Meta data -->
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
@yield('styles')
<!-- Switcher CSS -->

	<body class="default-header">
		
		<!-- Switcher -->
		<div class="switcher-wrapper">
		<div class="demo_changer">
			<div class="demo-icon bg_dark">
				<i class="fa fa-cog fa-spin text_primary"></i>
			</div>
		</div>
		<!-- Switcher -->
		
		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('assets/images/svgs/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<div class="page">
			<div class="page-main">
			<div class="header">
					<div class="container">
						<div class="d-flex">
						    <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
							<a class="header-brand" href="index.html">

							</a><!-- LOGO -->
							<div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
							    <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="fa fa-search"></i></a>
								<div class="">
									<form class="form-inline">
										<div class="search-element">
											<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
											<button class="btn btn-primary-color" type="submit"><i class="fa fa-search"></i></button>
										</div>
									</form>
								</div><!-- SEARCH -->
								<div class="dropdown d-md-flex">
									<a class="nav-link icon full-screen-link nav-link-bg" id="fullscreen-button">
										<i class="fe fe-maximize-2" ></i>
									</a>
								</div><!-- FULL-SCREEN -->
								<div class="sidebar-link">
									<a href="#" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
										<i class="fe fe-align-right" ></i>
									</a>
								</div><!-- FULL-SCREEN -->
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
                                    <li aria-haspopup="true"><a href="{{route('attachement.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Attachement </a></li>
                                    <li aria-haspopup="true"><a href="{{route('client.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Prestataire </a></li>
                                    <li aria-haspopup="true"><a href="{{route('fournisseur.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Client </a></li>
                                    <li aria-haspopup="true"><span class="horizontalMenu-click">
                                    <i class="horizontalMenu-arrow fa fa-angle-down"></i></span><a href="#" class="sub-icon"><i class="fe fe-pie-chart"></i> Factures 
                                    <i class="fa fa-angle-down horizontal-icon"></i></a> <ul class="sub-menu"> 
                                        <li aria-haspopup="true"><a href="{{route('facture.type.attachement')}}">Attachement</a></li> 
                                        <li aria-haspopup="true"><a href="{{route('facture.type.camion')}}"> Camions</a></li> 
                                    </ul>
                                    </li>

                                    <li aria-haspopup="true"><a href="{{route('sms.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Sms </a></li>
                                    <li aria-haspopup="true"><a href="{{route('payment.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Payments </a></li>
                                    <li aria-haspopup="true"><a href="{{route('fichier.index')}}" class="sub-icon"><i class="fe fe-airplay"></i> Fichiers </a></li>
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
				<div class="container content-area relative">
										   <!-- PAGE-HEADER -->
                    @yield('content')
					<!-- PAGE-HEADER END -->
											<!-- ROW-1 OPEN -->
				</div>
				<!-- CONTAINER CLOSED -->

			</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="{{route('attachement.create')}}" method="post" enctype="multipart/form-data">
			@csrf
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="example-file-input-custom">
                <label class="custom-file-label">Choose file</label>
            </div>
            <br>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>

		</form>


      </div>
    </div>
  </div>
</div>


	<footer class="footer">
		<div class="container">
			<div class="row align-items-center flex-row-reverse">
				<div class="col-md-12 col-sm-12 text-center">
					Copyright © 2019 <a href="#">Solic</a>. Designed by <a href="#">Spruko Technologies Private Limited</a> All rights reserved.
				</div>
			</div>
		</div>
	</footer>
<!-- FOOTER END -->		</div><!-- End Page -->
			<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>
<!-- JQUERY SCRIPTS -->
@yield('scripts')

	</body>

<!-- Mirrored from laravel.spruko.com/solic/Horizontal-Light-ltr/datatable by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Sep 2020 16:42:22 GMT -->
</html>
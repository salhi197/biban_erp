
<!doctype html>
<html lang="en" dir="ltr">
	
<!-- Mirrored from laravel.spruko.com/solic/Horizontal-Light-ltr/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Sep 2020 16:37:27 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Solic – Bootstrap Responsive Modern Simple Dashboard Clean HTML Premium Admin Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="html5 template, admin panel html template,  html5 admin template, admin panel html, admin panel html template, html css admin templates, dashboard html5, html dashboard template, simple dashboard html template, html5 dashboard template, dashboard html5,  simple dashboard html, dashboard design template, bootstrap 4 admin template,  bootstrap admin template,  admin, premium admin templates, best bootstrap admin template, bootstrap dashboard template,   admin ui templates, modern admin template, admin panel template bootstrap 4 "  />
		<!--favicon -->
<link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
<link rel="shortcut icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
<!-- TITLE -->
<title>Bibanfret | Login</title>
<!-- DASHBOARD CSS -->
<link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/dashboard-dark.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/style-modes.css')}}" rel="stylesheet"/>
<!-- HORIZONTAL-MENU CSS -->
<link href="{{asset('assets/plugins/horizontal-menu/dropdown-effects/fade-down.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/horizontal-menu/horizontal-menu.css')}}" rel="stylesheet">
<!--C3.JS CHARTS PLUGIN -->
<link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet"/>
<!-- SINGLE-PAGE CSS -->
<link href="{{asset('assets/plugins/single-page/css/main.css')}}" rel="stylesheet" type="text/css">
<!-- PERFECT SCROLL BAR CSS-->
<link href="{{asset('assets/plugins/pscrollbar/perfect-scrollbar.css')}}" rel="stylesheet" />
<!--- FONT-ICONS CSS -->
<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet"/>
<!-- SELECT2 CSS -->
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
<!-- Skin css-->
<link href="{{asset('assets/skins/skins-modes/color1.css')}}"  id="theme" rel="stylesheet" type="text/css" media="all" />
<!-- SIDEBAR CSS -->
<link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

<!-- Switcher CSS -->
<link href="{{asset('assets/switcher/css/switcher.css')}}" rel="stylesheet">
<link href="{{asset('assets/switcher/demo.css')}}" rel="stylesheet">	</head>
		
	<body class="default-header">	    
				<!-- BACKGROUND-IMAGE -->
		<div class="login-img">

			<!-- GLOABAL LOADER -->
			<div id="global-loader">
				<img src="assets/images/svgs/loader.svg" class="loader-img" alt="Loader">
			</div>

			<div class="page">
				<div class="">
				    <!-- CONTAINER OPEN -->
					<div class="col col-login mx-auto">
						<div class="text-center">
                            <img src="{{asset('img/logo-biban.png')}}" class="" alt="Loader">
						</div>
					</div>
					<div class="container-login100">
						<div class="wrap-login100 p-6">
							
                            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
								<span class="login100-form-title">
									Authentification
								</span>
								<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

									<span class="focus-input100"></span>
									<span class="symbol-input100">
									</span>
								</div>
								<div class="wrap-input100 validate-input" data-validate = "Password is required">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
										<span class="focus-input100"></span>
									<span class="symbol-input100">
									</span>
								</div>
								<div class="text-right pt-1">
									<p class="mb-0"><a href="forgot-password.html" class="text-primary ml-1">Forgot Password?</a></p>
								</div>
								<div class="container-login100-form-btn">
									<button type="submit" href="#" class="login100-form-btn btn-primary">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
					<!-- CONTAINER CLOSED -->
				</div>
			</div>
		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->
		
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
<!-- SELECT2 JS -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<!-- INPUT MASK PLUGIN-->
<script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>
<!-- CUSTOM SCROLL BAR JS-->
<script src="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- CUSTOM JS-->
<script src="{{asset('assets/js/custom.js')}}"></script>	
	</body>

<!-- Mirrored from laravel.spruko.com/solic/Horizontal-Light-ltr/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Sep 2020 16:37:36 GMT -->
</html>


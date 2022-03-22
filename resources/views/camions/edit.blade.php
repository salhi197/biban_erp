@extends('layouts.option')

@section('content')
                    <div class="page-header">
						<h4 class="page-title">Tables Attachements</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">camion</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md">
							<div class="card overflow-hidden">
                                <form class="card" action="{{route('camion.update',['camion'=>$camion->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" class="form-control" 
                                                    value="{{$camion->id ?? ''}}" name="id"
                                                     placeholder="e.g: 26966-110-18" >

                                    <div class="card-header">
                                        <h3 class="card-title">Nouvea Camion : </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Matricule</label>
                                                    <input type="text" class="form-control" 
                                                    value="{{$camion->matricule ?? ''}}" name="matricule"
                                                     placeholder="e.g: 26966-110-18" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Numéro de téléphone : </label>
                                                    <input type="text" class="form-control" placeholder="Téléphone e.g: 0648-75-25-14" 
                                                    value="{{$camion->telephone ?? ''}}" name="telephone"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" placeholder="Adress" value="{{$camion->adress ?? ''}}" name="adress">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Ville</label>
                                                    <input type="text" class="form-control" placeholder="e.g : Alger" value="{{$camion->ville ?? ''}}" name="ville" >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="wd-200 mg-b-30" styles="padding:30px;">
                                                    <label class="form-label">Date premier installation:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                            </div>
                                                        </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" value="{{$camion->debut ?? ''}}" name="debut" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card shadow">
                                                    <div class="card-header">
                                                        <h3 class="mb-0 card-title">Joindre fichier (optionnel ) :  </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <input value="{{$camion->fichier ?? ''}}" name="fichier" type="file" class="dropify" data-height="300" />
                                                    </div>
                                                </div>
                                            </div><!-- COL END -->
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>

							</div>
						</div><!-- COL END -->
					</div>





					<!-- ROW CLOSED -->
@endsection
@section('styles')
<!-- DASHBOARD CSS -->
<link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/dashboard-dark.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/style-modes.css')}}" rel="stylesheet"/>
<!-- HORIZONTAL-MENU CSS -->
<link href="{{asset('assets/plugins/horizontal-menu/dropdown-effects/fade-down.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/horizontal-menu/horizontal-menu.css')}}" rel="stylesheet">
<!--C3.JS CHARTS PLUGIN -->
<link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet"/>
<!-- TABS CSS -->
<link href="{{asset('assets/plugins/tabs/style-2.css')}}" rel="stylesheet" type="text/css">
<!-- TIME PICKER CSS -->
<link href="{{asset('assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet"/>
<!-- DATE PICKER CSS -->
<link href="{{asset('assets/plugins/date-picker/spectrum.css')}}" rel="stylesheet"/>
<!-- MULTI SELECT CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}">
<!-- FILE UPLODES -->
<link href="{{asset('assets/plugins/fileuploads/css/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
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
<link href="{{asset('assets/switcher/demo.css')}}" rel="stylesheet">

@endsection


@section('scripts')
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
<script src="{{asset('assets/plugins/pscrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/pscrollbar/pscroll-1.js')}}"></script>
<!-- SIDEBAR JS -->
<script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>
<!-- SELECT2 JS -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<script src="{{asset('assets/js/form-elements.js')}}"></script>
<!-- CHARTJS CHART -->
<script src="{{asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/chart/utils.js')}}"></script>
<!-- C3.JS CHART PLUGIN -->
<script src="{{asset('assets/plugins/charts-c3/d3.v5.min.js')}}"></script>
<script src="{{asset('assets/plugins/charts-c3/c3-chart.js')}}"></script>
<!-- INPUT MASK PLUGIN-->
<script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>
<!-- TIMEPICKER JS -->
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<!-- DATEPICKER JS -->
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<!-- FILE UPLOADES JS -->
<script src="{{asset('assets/plugins/fileuploads/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!-- MULTI SELECT JS-->
<script src="{{asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{asset('assets/plugins/multipleselect/multi-select.js')}}"></script>
<!-- STICKY JS -->
<script src="{{asset('assets/js/stiky.js')}}"></script>
<!-- CUSTOM JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- Switcher JS -->
<script src="{{asset('assets/switcher/js/switcher.js')}}"></script>	



@endsection

@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">
                            Archive Sms
                        </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">sms</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
                            
							<div class="card">

                                <div class="card-header">
                                    <a class="text-white btn btn-primary" href="/sms/create">
										<i class="fa fa-plus"></i> Envoyer Sms 
									</a>
                                    &nbsp;
								</div>
								<div class="card-header">
                                    <a class="text-white btn btn-primary" href="/sms/create/groupe">
										<i class="fa fa-plus"></i> Envoyer Groupe Sms 
									</a>
                                    &nbsp;
								</div>


                            
                                <div class="card-body">
									<div class="table-responsive">
										<table id="datatable-2" class="table table-bordered text-nowrap" >
											<thead>
												<tr>
													<th class="border-bottom-0">ID </th>
													<th class="border-bottom-0">Numéro</th>
													<th class="border-bottom-0">Contenu</th>

                                                    <th class="border-bottom-0">Utilisateur Qui a envoyé</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($smss as $sms)
												<tr>
                                                    <td>{{$sms->id ?? ''}}</td>
                                                    <td>{{$sms->numero ?? ''}}</td>
                                                    <td>{{$sms->contenu ?? ''}}</td>
                                                    <td>Admin</td>
												</tr>
                                                @endforeach
											</tbody>
										</table>


									</div>
								</div>
							</div>
						</div>
					</div>
@endsection

@section('styles')
<!-- TIME PICKER CSS -->
<link href="{{asset('assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet"/>
<!-- DATE PICKER CSS -->
<link href="{{asset('assets/plugins/date-picker/spectrum.css')}}" rel="stylesheet"/>
<style>

.dataTables_filter {
   width: 50%;
   float: left;
}

</style>

@endsection

@section('scripts')
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<script>
$(document).ready(function() {




    var settings = {
      "url": "http://sms.icosnet.com:8080/bulksms/bulksms?username=BIBAN_FRET&password=SMS3265&type=0&dlr=1&destination=213794498727&source=BIBAN%20FRET&message=da&ip=141.94.30.33",
      "method": "GET",
      "timeout": 0,
    };
    
    $.ajax(settings).done(function (response) {
      console.log(response);
    });


    $('.fournisseurs-multiple').select2();
    $('.fournisseurs-multiple-sms').select2({
        width: 'resolve' // need to override the changed default
    });

    $( "#generate" ).on('click',function(e){
        e.preventDefault()
        console.log('te')
        $('#formgenerate').submit();//('test');
    });

    $( "#filter" ).on('click',function(e){
        e.preventDefault()
        $('#formfilter').submit();//('test');
    });


});
</script>
@endsection

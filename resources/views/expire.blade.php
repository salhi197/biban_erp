@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Tables Des Notifacations</h4>
						<ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Client</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                    &nbsp;
                                    <!-- <a class="btn btn-primary" href="{{route('camion.index')}}">
                                        Chercher Camion
                                    </a> -->
                                    &nbsp;
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSms">
                                        S.M.S
                                    </button> -->
								</div>



								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-2" class="table table-bordered text-nowrap" >
											<thead>
												<tr>
													<th class="border-bottom-0">ID </th>
													<th class="border-bottom-0">Notifacation</th>
													<th class="border-bottom-0">Date</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>


									</div>
								</div>
							</div>
						</div>
					</div>
@endsection

@section('modals')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Affecter un matricule à un client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="{{route('fournisseur.affecter')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Client :  </label>
                    <select class="form-control"  name="fournisseur" size="5">
                        <option value="">Client ... </option>
                    </select>
                    <a class="{{route('fournisseur.show.create')}}" >Nouveau Client</a>


            </div>


            <label class="form-label">Matricule :  </label>
            <input type="text" class="form-control" 
                name="matricule"
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>

		</form>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="modalSms" tabindex="-1" role="dialog" aria-labelledby="modalSmsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSmsLabel">Enovyer Sms :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="{{route('send.sms')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Client :  </label>
                    <select class="form-control fournisseurs-multiple-sms"   style="width: 75%" name="fournisseur">
                        <option value="">Client ... </option>
                    </select>
            </div>


            <label class="form-label">Text  :  </label>
            <textarea name="contenu" class="form-control">

            </textarea>
            <br>


            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>

		</form>
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

@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">
                            Les elements de la Facture N° :  {{$facture->numero_facture ?? ''}}
                            @if($filter == 1)
                                {{$type ?? ''}}
                            @endif
                        </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">Attachements</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                    <div class="col-md-12 col-lg-12">
                                    <form class="row" method="post" action="{{route('attachement.filter')}}" id="formfilter">
                                            @csrf
                                        </form>
                                    </div> 
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-5" class="table table-bordered key-buttons text-nowrap" >
                                        <thead>
												<tr>
													<th class="border-bottom-0">N FDR</th>
													<th class="border-bottom-0">Matricule</th>
													<th class="border-bottom-0">Chauffeur</th>
													<th class="border-bottom-0">Date </th>
													<th class="border-bottom-0">Type </th>
													<th class="border-bottom-0">Site_charge</th>
													<th class="border-bottom-0">Site_charge</th>
													<th class="border-bottom-0">Quantité</th>
												</tr>
											</thead>
											<tbody>
                                            @foreach($clients as $client)
												<tr>
                                                    <td>{{$client->num_mission ?? '' }}</td>
                                                    <td>{{$client->matricule_camion ?? '' }}</td>
													<td>{{$client->nom_chauffeur ?? '' }}</td>
													<td>{{$client->date_reservation ?? '' }}</td>
													<td>{{$client->type_emballage ?? '' }}</td>
													<td>{{$client->site_de_chargement ?? '' }}</td>
													<td>{{$client->ville ?? '' }} {{$client->adresse ?? ''}}</td>
													<td>{{$client->qte_facturee ?? '' }}</td>
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

@section('modals')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">joindre fichier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="{{route('attachement.create')}}" method="post" enctype="multipart/form-data">
			@csrf
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="example-file-input-custom">
                <label class="custom-file-label">Choisir fichier</label>
                <br>
            <br>

            </div>
            <button type="submit" class="btn btn-primary">Importer</button>

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


@endsection

@section('scripts')
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
@endsection

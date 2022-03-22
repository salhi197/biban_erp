@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Tables des fiches clients  :  </h4>
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
                                            <form class="row" method="post" action="{{route('client.filter')}}" id="formfilter">
                                                @csrf
                                                @if($filter == 0)
                                                <div class="col-md-1">
                                                    <a class="text-white btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                        <i class="fa fa-upload"></i> excel 
                                                    </a>
                                                </div>
                                                @endif


                                                <div class="col-md-2">
                                                    <input class="form-control" value="{{$debut_entre ?? ''}}" placeholder="MM/DD/YYYY" name="debut_entre" type="date">
                                                </div>

                                                <div class="col-md-2">
                                                    <input class="form-control" value="{{$fin_entre ?? ''}}" placeholder="MM/DD/YYYY" name="fin_entre" type="date">
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="input-group">
                                                        <select class="form-control w-100 camions-multiple" name="matricules[]" multiple="multiple">
                                                            <option value="">Séléctionner camions</option>
                                                            @foreach($matricules as $matricule)
                                                                <option selected value="{{$matricule ?? ''}}"
                                                                >{{$matricule ?? ''}}</option>
                                                            @endforeach

                                                            @foreach($camions as $camion)
                                                                <option value="{{$camion->matricule ?? ''}}"
                                                                >{{$camion->matricule ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group">
                                                        <select class="form-control select2 w-100 type-emballage-multiple" name="type_emballages[]" multiple="multiple">
                                                                @foreach($type_emballages as $type_emballage)
                                                                        <option selected value="{{$type_emballage ?? ''}}"
                                                                        >{{$type_emballage ?? ''}}</option>
                                                                    @endforeach

                                                                <option value="">Séléctionner Type Emballage</option>
                                                                <option value="v"    >v</option>
                                                                <option value="p"    >p</option>
                                                                <option value="s"    >s</option>
                                                                <option value="clv"  >clv</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-2">
                                                    <div class="input-group">
                                                        <select class="form-control select2 type-multiple" name="types[]" multiple="multiple">
                                                            <option value="">Site de Chargement</option>
                                                            @foreach($types as $type)
                                                                <option selected value="{{$type ?? ''}}">{{$type ?? ''}}</option>
                                                            @endforeach

                                                            <option value="Usine Biskra" @if(in_array("Usine Biskra",$types)) selected @endif>CILAS</option>
                                                            <option value="Usine M'Sila" @if(in_array("Usine M\'Sila",$types)) selected @endif>LCM</option>
                                                            <option value="Usine Oggaz"  @if(in_array("Usine Oggaz",$types)) selected @endif >Oggaz</option>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <button class="btn btn-primary" type="buton" id="filter">
                                                        <i class="fa fa-filter"></i> filtrer 
                                                    </button>
                                                </div>



                                            </form>
                                            
                                            @if($filter==1)
                                            <form class="row" method="post" action="{{route('client.generer')}}" id="formgenerate">
                                                @csrf
                                                    <input class="form-control" value="{{$debut_entre ?? ''}}" name="debut_entre" type="hidden">
                                                    <input class="form-control" value="{{$fin_entre ?? ''}}" name="fin_entre" type="hidden">
                                                    <input class="form-control" value="{{json_encode($matricules) ?? ''}}" name="matricules" type="hidden">
                                                    <input class="form-control" value="{{json_encode($types) ?? ''}}" name="types" type="hidden">
                                                    <input class="form-control" value="{{json_encode($type_emballages) ?? ''}}" name="type_emballages" type="hidden">
                                                    
                                                    <button class="btn btn-primary float-right" type="button" id="generate" >
                                                            <i class="fa fa-plus"></i> Générer facture 
                                                        </button>
                                            </form>
                                             @endif
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
        <h5 class="modal-title" id="exampleModalLabel">joindre fichier : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="{{route('client.create')}}" method="post" enctype="multipart/form-data">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


@endsection

@section('scripts')
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.camions-multiple').select2({
        placeholder: "Camion",
        width: '100%' // need to override the changed default
    });

    $('.type-multiple').select2({
        placeholder: " Type",
        width: '100%' // need to override the changed default
    });
    $('.type-emballage-multiple').select2({
        placeholder: "Emballage",
        width: '100%' // need to override the changed default
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

    $('.custom-file-input').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });


});
</script>
@endsection

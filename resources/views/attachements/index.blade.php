@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">
                            Tables Attachements
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
                                            @if($filter == 0)
                                            <div class="col-md-2">
                                                <a class="text-white btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="fa fa-plus"></i> Importer Excel 
                                                </a>
                                            </div>
                                            @endif

                                            <div class="col-md-2">
                                                <input class="form-control" placeholder="YYYY/MM/DD" value="{{$debut_entre ?? ''}}" name="debut_entre" type="date">
                                            </div>

                                            <div class="col-md-2">
                                                <input class="form-control" placeholder="YYYY/MM/DD" value="{{$fin_entre ?? ''}}" name="fin_entre" type="date">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <select class="form-control select2 w-100" name="type" >
                                                        <option value="">Site de Chargement </option>
                                                        <option value="VRAC LCM" @if($type =='VRAC LCM' ) selected @endif  >VRAC LCM</option>
                                                        <option value="SAC LCM" @if($type =='SAC LCM' ) selected @endif  >SAC LCM</option>
                                                        <option value="VRAC LCO" @if($type =='VRAC LCO' ) selected @endif>VRAC LCO</option>
                                                        <option value="SAC LCO" @if($type =='SAC LCO' ) selected @endif  >SAC LCO</option>
                                                        <option value="SAC CILAS" @if($type =='SAC CILAS' ) selected @endif>SAC CILAS </option>
                                                        <option value="VRAC CILAS" @if($type =='VRAC CILAS' ) selected @endif>VRAC CILAS </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <button class="btn btn-primary" type="buton" id="filter">
                                                    <i class="fa fa-filter"></i> Filtrer 
                                                </button>
                                            </div>
                                            @if($filter == 1)
                                            <div class="col-md-2 float-right">
                                            <button class="btn btn-primary" type="button" id="generate">
                                                  <i class="fa fa-plus"></i>  Générer Facture 
                                                </button>
                                            </div>
                                            @endif
                                        </form>


<br>

                                    @if($filter == 1)
                                    <form class="row" method="post" action="{{route('attachement.generer')}}" id="formgenerate">
                                            @csrf
                                                <input class="form-control" placeholder="YYYY/MM/DD" value="{{$debut_entre ?? ''}}" name="debut_entre" type="hidden">
                                                <input class="form-control" placeholder="YYYY/MM/DD" value="{{$fin_entre ?? ''}}" name="fin_entre" type="hidden">
                                                <input class="form-control" placeholder="YYYY/MM/DD" value="{{$type ?? ''}}" name="type" type="hidden">

                                        </form>
                                    @endif

                                    </div> 
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-5" class="table table-bordered key-buttons text-nowrap" >
											<thead>
												<tr>
                                                <th class="border-bottom-0">N°Facture</th>
                                                <th class="border-bottom-0">Type</th>
                                                    <th class="border-bottom-0">Date</th>
                                                    <th class="border-bottom-0">N°FDR</th>
                                                    <th class="border-bottom-0">Ville</th>
                                                    <th class="border-bottom-0">Wilaya</th>
													<th class="border-bottom-0">Quantité</th>
												</tr>
											</thead>
											<tbody>
                                            @foreach($attachements as $key=>$attachement)
												<tr>
                                                <?php $index = $key+1; ?>
                                                <td>{{$index ?? '' }}</td>
                                                <td>{{$attachement->type ?? '' }}</td>
                                                <td>{{$attachement->date_facture ?? '' }}</td>
                                                    <td>{{$attachement->mission ?? '' }}</td>
													<td>{{$attachement->ville ?? '' }}</td>
													<td>{{$attachement->wilaya ?? '' }}</td>
													<td>{{$attachement->somme_de_qte_facturee ?? '' }}</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Joindre fichier</h5>
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
<script>
$(document).ready(function() {
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

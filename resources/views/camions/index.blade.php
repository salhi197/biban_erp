@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">
                            Tables camions
                        </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">camions</li>
						</ol>
					</div>

					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Affecter nouveau camion
                                    </button>


								</div>

								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-5" class="table table-bordered key-buttons text-nowrap" >
											<thead>
												<tr>
                                                <th class="border-bottom-0">Id</th>
                                                <th class="border-bottom-0">Matricule</th>
    											<th class="border-bottom-0">Client (nom & prenom)</th>
    											<th class="border-bottom-0">Actions</th>
												</tr>
											</thead>
											<tbody>
                                            @foreach($camions as $key=>$camion)
												<tr>
                                                    <?php $index = $key+1; ?>
                                                    <td>{{$index ?? '' }}</td>
                                                    <td>{{$camion->matricule ?? '' }}</td>
                                                    <td>
                                                    {{$camion->fournisseur()['nom'] ?? '' }}

                                                    {{$camion->fournisseur()['prenom'] ?? '' }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example{{$camion->id}}">
                                                            @if($camion->fournisseur())
                                                                <i class="fa fa-edit"></i>
                                                            @else
                                                                Affecter à client                                     
                                                            @endif
                                                        </button>

                                                        <a class="btn btn-danger text-white"
                                                        href="{{route('camion.destroy',['camion'=>$camion->id])}}" 
                                                        onclick="return confirm('etes vous sure  ?')"
                                                        >
                                                            supprimer                                  
                                                        </a>


                                                    </td>

                                                    <div class="modal fade" id="example{{$camion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Affecter le camion {{$camion->matricule }} : </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('fournisseur.affecter.update')}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" class="form-control" 
                                                                        name="matricule"
                                                                        value="{{$camion->id}}" >

                                                                    <div class="form-group">
                                                                        <label class="form-label">Client :  </label>
                                                                            <select class="form-control"  name="fournisseur" size="5"> name="fournisseur" >
                                                                                <option value="">Client ... </option>
                                                                                @foreach($fournisseurs as $key=>$fournisseur)
                                                                                    <option value="{{$fournisseur->id}}">{{$fournisseur->nom}} {{$fournisseur->prenom}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                    </div>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>

                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>



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
        <h5 class="modal-title" id="exampleModalLabel">Affecter un matricule à un client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="{{route('fournisseur.affecter')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label class="form-label">Matricule :  </label>
            <input type="text" class="form-control" 
                name="matricule"
                value="" >

            <div class="col-md-3">
                <label class="form-label">Carte Grise</label>
                <input type="file" name="carte_grise" id="carte_grise" class="form-file">
            </div>
            <div class="form-group">
                <label class="form-label">Client :  </label>
                    <select class="form-control"  name="fournisseur" size="5"> name="fournisseur" >
                        <option value="">Client ... </option>
                        @foreach($fournisseurs as $key=>$fournisseur)
                            <option value="{{$fournisseur->id}}">{{$fournisseur->nom}} {{$fournisseur->prenom}}</option>
                        @endforeach
                    </select>


            </div>
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

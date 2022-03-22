@extends('layouts.admin')

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
                                <form class="card" action="{{route('fournisseur.update',['fournisseur'=>$fournisseur->id])}}" method="post">
                                    @csrf
                                    <div class="card-header">
                                        <h3 class="card-title">Nouveau Client : </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Nom : </label>
                                                    <input type="text" class="form-control" 
                                                    name="nom"
                                                    value="{{ $fournisseur->nom }}"
                                                     placeholder="nom : " >
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">prenom: </label>
                                                    <input type="text" class="form-control"     
                                                    name="prenom"
                                                    value="{{ $fournisseur->prenom }}"
                                                    placeholder="prenom : " >
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">telephone : </label>
                                                    <input type="text" class="form-control" 
                                                    name="telephone"
                                                    value="{{$fournisseur->telephone}}"
                                                     placeholder="e.g: 055-11-02-33" >
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">R.I.B: </label>
                                                    <input type="text" class="form-control" placeholder="RIB" 
                                                    name="rib"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" placeholder="Adress" name="adress" value="{{$fournisseur->adress}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Ville</label>
                                                    <input type="text" class="form-control" placeholder="e.g : Alger" name="ville" value="{{$fournisseur->ville}}" >
                                                </div>
                                            </div>


                                                        <div class="col-md-3">
                                                            <label class="form-label">Permis</label>
                                                            <a  name="permis" href="{{'/storage/app/public/'.$fournisseur->permis}}" >permis</a>
                                                        </div>

                                            <!-- <div class="col-lg-12">
                                                <div class="card shadow">
                                                    <div class="card-header">
                                                        <h3 class="mb-0 card-title">Joindre fichier (optionnel ) :  </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <input name="fichier" type="file" class="dropify" data-height="300" />
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- COL END -->
                                        </div>
                                            @foreach($camions as $camion)
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Matricule</label>
                                                            <input type="text" name="matricule" id="matricule" value="{{$camion->matricule}}" placeholder="Matricule Camion ..." class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Carte Grise</label>
                                                            <a  name="carte_grise" href="{{'/storage/app/public/'.$camion->carte_grise}}" >carte grise</a>
                                                        </div>

                                                        <div class="button-group">
                                                            <a href="{{route('camion.destroy',['camion'=>$camion->id])}}" 
                                                            onclick="return confirm('etes vous sur ?')"
                                                            class="btn btn-danger" style="margin:27px;" ><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                            @endforeach



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
@section('scripts')
<script>
        $(document).ready(function() {
        	var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
		        limit:10,
		        formPrefix : "dynamic_form",
		        normalizeFullForm : false
		    });


		    $("#dynamic_form #minus5").on('click', function(){

		    	var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;

		    	if (initDynamicId === 2) {
		    		$(this).closest('#dynamic_form').next().find('#minus5').hide();
		    	}
		    	$(this).closest('#dynamic_form').remove();
		    });

		    $('#Commandeform').on('submit', function(event){
	        	var values = {};
				$.each($('#Commandeform').serializeArray(), function(i, field) {
				    values[field.name] = field.value;
				});
				console.log(values)
        	})
        });
</script>
@endsection

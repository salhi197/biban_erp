@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Tables Attachements {{$_type ?? ''}}</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">Attachements</li>
						</ol>
					</div>

					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                <button class="text-white btn btn-primary" id="x">
										<i class="fa fa-save"></i> Enregister la Facture 
									</button>
								</div>
                                <form action="{{route('facture.create')}}" method="post" id="y">
                                @csrf

                                <div class="card-body">
                                        <div class="row">
                                                    <input type="hidden" class="form-control" 
                                                    name="type_emballage"
                                                    value="{{$_type}}"
                                                     placeholder="" >

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Facture N° :  </label>
                                                    <input type="text" class="form-control" 
                                                    name="numero_facture"
                                                     placeholder="" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Raison Social: </label>
                                                    <input type="text" class="form-control"  
                                                    name="raison"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Addresse Bureau :</label>
                                                    <input type="text" class="form-control" placeholder="Adress" name="adress">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">N°RC :</label>
                                                    <input type="text" class="form-control" placeholder="" name="registre" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">NIF :</label>
                                                    <input type="text" class="form-control" placeholder="" name="i_f" >
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">NIS :</label>
                                                    <input type="text" class="form-control" placeholder="" name="nis" >
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">AI :</label>
                                                    <input type="text" class="form-control" placeholder="" name="ai" >
                                                </div>
                                            </div>

                                        </div>
                                    </div>



	
								<div class="card-body">
									<div class="table-responsive">
                                        <input type="hidden" name="type" value="attachements" />
                                        <input type="hidden" name="items" value="" id="items"/>
                                        <input type="hidden" name="unix" value="" id="unix"/>
                                        <input type="hidden" name="attachements" value="{{$ids ?? ''}}" />
                                        
                                        
                                        <table id="datatable-2" class="table table-striped table-bordered w-100 text-nowrap display ">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Désignation</th>
                                                        <th>Quantité</th>
                                                        <th>Rotation</th>
                                                        <th>Prix unitaire</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php  
                                                    $total_rotations = 0;   
                                                ?>

                                                @foreach($attachements as $key=>$attachement)
                                                <?php  
                                                    $total_rotations = $total_rotations+$attachement->rotations;   
                                                ?>
                                                    <input type="hidden" value="{{json_encode($attachement,true)}}" name="items[]"  >
                                                    <tr>
                                                        <td><?php $index = $key+1;?> {{$index}}</td>
                                                        <td>
                                                            <?php $designation = $attachement->ville.' '.$attachement->wilaya; ?>
                                                        <input type="hidden"  name="dynamic_form[dynamic_form][{{$key}}][designation]" id="row-{{$key}}-designation" value="{{$designation}}" />
                                                        {{ $designation ?? $attachement->designation }}
                                                        </td>
                                                        <td>
                                                        <input type="hidden" name="dynamic_form[dynamic_form][{{$key}}][quantite]" value="{{$attachement->quantite ?? '' }}" />
                                                        {{$attachement->quantite ?? '' }}
                                                         </td>
                                                        <td>
                                                        <input type="hidden" name="dynamic_form[dynamic_form][{{$key}}][rotations]" value="{{$attachement->rotations ?? '' }}" />
                                                        {{$attachement->rotations ?? '' }} </td>
                                                        <td>
                                                        
                                                        <input type="number" class="form-control prix_unitaire" 
                                                            onchange="watchPrixUnitaireChange({{$key}})"
                                                            data-rotation="{{$attachement->rotations ?? ''}}"
                                                            data-qte="{{$attachement->quantite}}" data-key="{{$key}}" id="row-{{$key}}-age" name="dynamic_form[dynamic_form][{{$key}}][prix]"
                                                            value="{{$attachement->prix ?? ''}}"
                                                              ></td>
                                                        <td>
                                                        <input 
                                                        value="{{$attachement->total ?? ''}}"
                                                        type="text" readonly class="form-control sub-total"  id="row-{{$key}}-position" name="dynamic_form[dynamic_form][{{$key}}][total]" ></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                    <tfoot>
                                                    <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">Total HT</th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" readonly class="form-control" id="totalht" value="0">
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">TVA (19%)</th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" name="tva" class="form-control" id="tva" value="0"
                                                            onchange="watchTva()" readonly="true"
                                                            >
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">Total TTC</th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" readonly class="form-control" id="total" value="0">
                                                            </th>
                                                        </tr>

                                                    </tfoot>

                                            </table>
                                            
                                                <button class="text-white btn btn-primary float-right" id="z">
                                                        <i class="fa fa-save"></i> Enregister la Facture 
                                                    </button>

                                        </form>
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


@endsection

@section('scripts')
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<script>

function watchPrixUnitaireChange(key)
{
        var unix = $('#unix').val()
        
        var obj = JSON.parse(localStorage.getItem(unix))  || {};
        
        var rotations = parseFloat($('#row-'+key+'-age').data('rotation')).toFixed(2)
        var quantite = parseFloat($('#row-'+key+'-age').data('qte')).toFixed(2)
        var designation = $('#row-'+key+'-designation').val();
        var valueSelected = $('#row-'+key+'-age').val();
        var total = parseFloat($('#row-'+key+'-age').data('qte')).toFixed(2) * valueSelected 

        $('#row-'+key+'-position').val(total)
        // var AllTotal = $('#totalht').val()
        // AllTotal = parseFloat(AllTotal)+total
        // $('#totalht').val(AllTotal)
        // var t_tva = 19/100*$('#totalht').val() 
        // $('#tva').val(parseFloat(t_tva).toFixed(2))
        // var final_total = parseFloat($('#tva').val()) +parseFloat($('#totalht').val()) 
        // $('#total').val(parseFloat(final_total).toFixed(2))
        var nObj = {
            id:key,
            prixht:valueSelected,
            quantite:quantite,
            rotations:rotations,
            designation:designation,
            total:total
        }; 

        obj[key] = nObj;
        localStorage.setItem(unix, JSON.stringify(obj));
        $('#items').val(JSON.stringify(obj));
        console.log(obj);
        var _total = 0
        var _totalHt = 0

        
        for (let [key, value] of Object.entries(obj)) {
            console.log(`${key}: ${value.prixht}`);
            _totalHt+=parseFloat(value.prixht*value.quantite);
            console.log(_totalHt)
        }
        _tva = parseFloat(19/100*_totalHt).toFixed(2)
        _total = parseFloat(_tva + _totalHt).toFixed(2) 
        $('#totalht').val(_totalHt)
        $('#tva').val(_tva)
        $('#total').val(parseFloat(parseFloat(_totalHt)+parseFloat(_tva)))

}

function watchTva()
{
        var tva = $('#tva').val();
        var t = 19/100*$('#totalht').val()
        var newTotal = t+parseFloat($('#totalht').val()).toFixed(2)
        $('#total').val(newTotal)


}
$(document).ready(function(){
$('#unix').val(Math.round(+new Date()/1000));
 $("#x").click(function(e){
    $("#y").submit();
 })

 $("#z").click(function(e){
    $("#y").submit();
 })



});


</script>

@endsection

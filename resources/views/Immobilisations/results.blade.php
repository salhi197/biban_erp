@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Générer Facture Camion : code produit {{$type_emballage ?? ''}} , {{$type ?? ''}} </h4>
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
										<i class="fa fa-save"></i> enregister la facture 
									</button>
								</div>



                                <div class="card-body">
                                    <form action="{{route('facture.save')}}" method="post" id="y">
                                            @csrf

                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="hidden" class="form-control" 
                                                        name="type_emballage"
                                                        value="{{$type_emballage ?? ''}}"
                                                        placeholder="" >
                                                <input type="hidden" class="form-control" 
                                                        name="_type"
                                                        value="{{$ype ?? ''}}"
                                                        placeholder="" >
                                            </div>

                                        </div>
                                    </div>



								<div class="card-body">
									<div class="table-responsive">
                                        <input type="hidden" name="type" value="immobilisations" />
                                                    <input type="hidden" name="items" value="" id="items"/>
                                                    <input type="hidden" name="unix" value="" id="unix"/>
                                                    <input type="hidden" name="matricule" value="{{$matricule ?? ''}}" />
                                                    <input type="hidden" name="assurance" id="_assurance"/>
                                                    <input type="hidden" name="gaz" id="_gaz"/>
                                                    <input type="hidden" name="gps" id="_gps"/>
                                                    <input type="hidden" name="attachements" value="{{$ids ?? ''}}" />
                                                    <input type="hidden" name="sous-total" id="_sous-total" value="" />
                                                    <input type="hidden" name="fournisseur" id="fournisseur" value="{{$fournisseur ?? ''}}" />
                                                    


                                                    
                                        <table id="datatable-2" class="table table-striped table-bordered w-100 text-nowrap display ">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Désignation</th>
                                                        <th>Type</th>
                                                        <th>Quantité</th>
                                                        <th>Rotation</th>
                                                        <th>Prix Ht</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($immobilisations as $key=>$immobilisation)
                                                    <input type="hidden" value="{{json_encode($immobilisation,true)}}" name="items[]"  >
                                                    
                                                    <tr>
                                                    <?php $designation = $immobilisation->ville.' '.$immobilisation->wilaya; ?>
                                                    <?php $index=$key+1;// = $immobilisation->ville.' '.$immobilisation->adresse; ?>

                                                        <td> {{$index}}</td>
                                                        <td>
                                                        <input type="hidden" id="row-{{$key}}-designation" name="dynamic_form[dynamic_form][{{$key}}][designation]" value="{{$immobilisation->ville.' '.$immobilisation->wilaya}}" />
                                                        {{ str_limit($immobilisation->ville.' '.$immobilisation->wilaya, $limit = 80, $end = '...') ?? $immobilisation->designation }}
                                                        </td>
                                                        <td>
                                                            {{ $immobilisation->type_emballage ?? '' }}
                                                        </td>

                                                        <td>
                                                        <input type="hidden" name="dynamic_form[dynamic_form][{{$key}}][quantite]" value="{{$immobilisation->qte_facturee ?? '' }}" />
                                                        {{$immobilisation->qte_facturee ?? '' }}
                                                         </td>
                                                        <td>
                                                            
                                                        <input type="hidden" name="dynamic_form[dynamic_form][{{$key}}][rotations]" value="1" />
                                                        1 </td>
                                                        <td>
                                                        
                                                        <input type="number" class="form-control prix_unitaire" 
                                                            onchange="watchPrixUnitaireChange({{$key}})"

                                                            value="{{$immobilisation->prix ?? ''}}"
                                                            data-qte="{{$immobilisation->qte_facturee}}" data-key="{{$key}}" id="row-{{$key}}-age" name="dynamic_form[dynamic_form][{{$key}}][prix]"  ></td>
                                                        <td>
                                                        <input 
                                                        value="{{$immobilisation->total ?? ''}}"
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
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">Sous Total: </th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" value="0" readonly="true" class="form-control" id="sous-total" >
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">le frais : </th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                        </tr>


                                                        <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">Assurance : </th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" value="0" class="form-control" id="assurance" >
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">Gaz</th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" value="0" class="form-control" id="gaz" >
                                                            </th>
                                                        </tr>



                                                        <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">GPS</th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" value="0" class="form-control" id="gps" >
                                                            </th>
                                                        </tr>



                                                        <tr>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1"></th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">Total</th>
                                                            <th class="border-bottom-0" rowspan="1" colspan="1">
                                                            <input type="number" readonly class="form-control" id="total" value="0">
                                                            </th>
                                                        </tr>

                                                    </tfoot>

                                            </table>
                                            <button class="text-white btn btn-primary float-right" id="z">
                                                        <i class="fa fa-save"></i> Enregister Facture 
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

        var newTotal = parseFloat(parseFloat(_totalHt) -  parseFloat($('#gaz').val()) - parseFloat($('#assurance').val()) - parseFloat($('#gps').val()) )

        $('#total').val(parseFloat(newTotal).toFixed(2))
        $('#sous-total').val(parseFloat(newTotal).toFixed(2))
        

}


function watchTva()
{
        var tva = $('#tva').val();
        var t = 19/100*$('#totalht').val()
        var newTotal = t+parseInt($('#totalht').val())
        $('#total').val(parseFloat(newTotal).toFixed(2))
}

function watchAssurance()
{
    $('#assurance').on('change',function(){
        if ($('#assurance').val().length == 0 || $('#assurance').val() == 0) {
            console.log('sa')
            var newTotal = parseFloat($('#total').val())+ parseFloat($('#_assurance').val());
            $('#total').val(parseFloat(newTotal).toFixed(2))
            $('#_assurance').val(0)
        }else{
            var newTotal = parseFloat($('#total').val())-parseFloat($('#assurance').val())
            $('#total').val(parseFloat(newTotal).toFixed(2))
            $('#_assurance').val(parseFloat($('#assurance').val()))
        }
    })
}
function watchGaz()
{
    $('#gaz').on('change',function(){
        if ($('#gaz').val().length == 0 || $('#gaz').val() == 0) {
            console.log('sa')
            var newTotal = parseFloat($('#total').val())+ parseFloat($('#_gaz').val());
            $('#total').val(parseFloat(newTotal).toFixed(2))
            $('#_gaz').val(0)
        }else{
            var newTotal = parseFloat($('#total').val())-parseFloat($('#gaz').val())
            $('#total').val(parseFloat(newTotal).toFixed(2))
            $('#_gaz').val(parseFloat($('#gaz').val()))
        }
    })
}
function watchGps()
{

    $('#gps').on('change',function(){
        if ($('#gps').val().length == 0 || $('#gps').val() == 0) {
            console.log('sa')
            var newTotal = parseFloat($('#total').val())+ parseFloat($('#_gps').val());
            $('#total').val(parseFloat(newTotal).toFixed(2))
            $('#_gps').val(0)
        }else{
            var newTotal = parseFloat($('#total').val())-parseFloat($('#gps').val())
            $('#total').val(parseFloat(newTotal).toFixed(2))
            $('#_gps').val(parseFloat($('#gps').val()))
        }
    })

    // $('#gps').on('change',function(){
    //     var newTotal = parseFloat($('#total').val())-parseFloat($('#gps').val())
    //     $('#total').val(parseFloat(newTotal).toFixed(2))
    //         $('#_gps').val(parseFloat($('#gps').val()))
    // })
}


$(document).ready(function(){
    watchAssurance()
    watchGaz()
    watchGps()
$('#unix').val(Math.round(+new Date()/1000));
 $("#x").click(function(e){
    console.log($('#items').val())
     $("#y").submit();
 })
 $("#z").click(function(e){
    console.log($('#items').val())
     $("#y").submit();
 })


});



</script>

@endsection

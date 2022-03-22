@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Consulter Facture</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil.</a></li>
							<li class="breadcrumb-item active" aria-current="page">Attachements</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                <a href="{{route('facture.download',['facture'=>$facture->id])}}" class="text-white btn btn-primary" id="x">
										<i class="fa fa-download"></i> Télécharger
									</a>
                                    &nbsp;
                                    <a class="btn btn-primary" href="{{route('facture.attachements',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Voir Attachement
                                                        </a>

								</div>

                                <form action="{{route('facture.update',['factrue'=>$facture->id])}}" method="post" id="y">
                                    @csrf
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Désignation :   </label>
                                                    <input type="text" class="form-control" 
                                                     name="numero_facture"
                                                    value=" {{$facture->_type ?? ''}}"
                                                     placeholder="" >
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Facture N° :  </label>
                                                    <input type="text" class="form-control" 
                                                     name="numero_facture"
                                                    value="{{$facture->numero_facture ?? ''}}"
                                                     placeholder="" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Raison Sociale: </label>
                                                    <input type="text" class="form-control" placeholder="Téléphone e.g: 0648-75-25-14" 
                                                    value="{{$facture->raison ?? ''}}"  name="raison"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Address Bureau :</label>
                                                    <input type="text" class="form-control" placeholder="Adress" value="{{$facture->adress ?? ''}}"  name="adress">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Registre de commerce :</label>
                                                    <input type="text" class="form-control" placeholder="" value="{{$facture->registre ?? ''}}"  name="registre" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Identification Fiscale :</label>
                                                    <input type="text" class="form-control" placeholder="" value="{{$facture->i_f ?? ''}}"  name="i_f" >
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">NIS :</label>
                                                    <input type="text" class="form-control" placeholder="" value="{{$facture->nis ?? ''}}"  name="nis" >
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">AI:</label>
                                                    <input type="text" class="form-control" placeholder="" value="{{$facture->ai ?? ''}}"  name="ai" >
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-12">
                                                <div class="form-group float-right">
                                                <button type="submit" class="btn btn-primary">
                                                        Enregistrer les modifications
                                                        </button>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>



	
	                                
								<div class="card-body">
									<div class="table-responsive">
                                    <form action="{{route('facture.create')}}" method="post" id="y">
                                        <input type="hidden" name="type" value="clients" />
                                        @csrf
                                        <table id="datatable-5" class="table table-striped table-bordered w-100 text-nowrap display  key-buttons">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Désignation</th>
                                                        <th>Quantité</th>
                                                        <th>Rotation</th>
                                                        <th>Prix Unitaire</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($attachements as $key=>$attachement)
                                                
                                                    <input type="hidden" value="{{json_encode($attachement,true)}}" name="items[]"  >
                                                    <tr>
                                                        <?php $designation = $attachement->ville.' '.$attachement->adresse; ?>
                                                        <?php $index=$key+1; ?>
                                                        <td> {{$index}}</td>
                                                        <td>
                                                        {{ $attachement->designation }}
                                                        </td>
                                                        <td>
                                                        {{$attachement->quantite ?? '' }}
                                                         </td>
                                                        <td>
                                                        {{$attachement->rotations ?? '' }} </td>
                                                        <td>
                                                        {{$attachement->prix ?? ''}}                                                       
                                                        <td>
                                                        {{$attachement->total ?? ''}}
                                                        </td>
                                                    </tr>
                                                    @endforeach                                                       
                                                </tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Total HT</td>
                                                    <td>
                                                    {{$facture->totalht ?? ''}}                                                           
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>TVA 19%</td>
                                                    <td>
                                                    {{$facture->tva ?? ''}}                                                           
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Total TTC</td>
                                                    <td>
                                                        {{$facture->tva +  $facture->totalht}}
                                                    </td>
                                                </tr>                                                



                                            </table>

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
@endsection

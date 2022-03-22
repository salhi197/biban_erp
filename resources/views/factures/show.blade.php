@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Consulter Facture</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">Attachements</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                <a href="{{route('facture.download',['facture'=>$facture->id])}}" class="text-white btn btn-primary" id="x">
										<i class="fa fa-download"></i> Télécharger.
									</a>
                                    &nbsp;
                                    <a class="btn btn-primary" href="{{route('facture.clients',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Voir Attachements
                                                        </a>



								</div>



	
	                                
								<div class="card-body">
									<div class="table-responsive">
                                    <form action="{{route('facture.create')}}" method="post" id="y">
                                        <input type="hidden" name="type" value="clients" />
                                        @csrf
                                        <table id="datatable-2" class="table table-striped table-bordered w-100 text-nowrap display  key-buttons">
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

                                                        <td> {{$key}}</td>
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
                                                        {{$attachement->quantite*$attachement->prix ?? ''}}
                                                        </td>
                                                    </tr>
                                                    @endforeach                                                       
                                                </tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Sous Total</td>
                                                    <td>
                                                    {{$facture->totalht ?? ''}}                                                           
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Assurance</td>
                                                    <td>
                                                    {{$facture->assurance ?? ''}}                                                           
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Gaz</td>
                                                    <td>
                                                    {{$facture->gaz ?? ''}}                                                           
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Gpg</td>
                                                    <td>
                                                    {{$facture->gps ?? ''}}                                                           
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Total</td>
                                                    <td>
                                                        {{ $facture->totalht -  $facture->gps - $facture->gaz -  $facture->assurance}}
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

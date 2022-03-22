@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Tables des payments</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">payments</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
                            
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="card " style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title">Montant Restant</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{$debt ?? ''}} DA</h6>
                                                </div>
                                            </div>
                                                
                                            <div class="col-md-1">&nbsp;</div>
                                            <div class="card" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title">Montant Payé: </h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{$payed ?? ''}} DA</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-1">&nbsp;</div>
                                            <div class="card" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title">Montant Facture : </h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{$total ?? ''}} DA</h6>
                                                </div>
                                            </div>

                                        </div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    										<i class="fa fa-plus"></i> Ajouter Paiment
                                        </button>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un Montant de Paiment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('payment.create')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" class="form-control" 
                                                            name="facture"
                                                            value="{{$facture->id ?? ''}}" >

                                                        <div class="form-group">
                                                            <label class="form-label">Montant :  </label>
                                                            <input type="number" class="form-control" 
                                                            name="montant"
                                                            placeholder="Montant e.g : 230.000,00 DA" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Date de Paiment :  </label>
                                                            <input type="date" class="form-control" 
                                                            name="date_payment"
                                                            placeholder="" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Type de Paiment :  </label>
                                                            <input type="text" class="form-control" 
                                                            name="type"
                                                            placeholder="" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">Remarque :  </label>
                                                            <input type="text" class="form-control" 
                                                            name="reqmarque"
                                                            placeholder="" >
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>

                                                    </form>

                                                </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>



	                            
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-2" class="table table-bordered key-buttons text-nowrap" >
											<thead>
												<tr>
													<th class="border-bottom-0">ID </th>
													<th class="border-bottom-0">Montant</th>
													<th class="border-bottom-0">type</th>
                                                    <th class="border-bottom-0">Remarque</th>                                                    
													<th class="border-bottom-0">Date Paiment</th>
													<th class="border-bottom-0">Crée le</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($payments as $payment)
												<tr>
													<td>{{$payment->id ?? ''}}</td>
													<td>
                                                        <span class="badge badge-success">{{$payment->montant ?? ''}} DA</span>                                                    
                                                    </td>
													<td>
                                                        <span class="badge badge-info">{{$payment->type ?? ''}}</span>
                                                    </td>

													<td>
                                                        {{$payment->remarque ?? ''}}
                                                    </td>

                                                    <td>{{$payment->date_payment ?? ''}}</td>
                                                    <td>{{$payment->created_at ?? ''}}</td>

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






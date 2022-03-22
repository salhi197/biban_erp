@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Tables des factures | Attachement</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">Factures</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-5" class="table table-bordered key-buttons text-nowrap" >
											<thead>
												<tr>
													<th class="border-bottom-0">N°Facture</th>
													<th class="border-bottom-0">Total HT</th>
													<th class="border-bottom-0">TVA (19%)</th>
													<th class="border-bottom-0">Total </th>
													<th class="border-bottom-0">crée le</th>
													<th class="border-bottom-0">Actions</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($factures as $facture)
												<tr>
													<td>{{$facture->numero_facture ?? ''}}</td>
													<td>{{$facture->totalht ?? ''}}</td>
													<td>{{$facture->tva ?? ''}}</td>
													<td>{{$facture->tva + $facture->totalht}}</td>
													<td>{{$facture->created_at ?? ''}} </td>
													<td>
                                                        <a class="btn btn-primary" href="{{route('facture.open',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Ouvrir
                                                        </a>
                                                        <a class="btn btn-primary" href="{{route('facture.attachements',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Voir Attachement
                                                        </a>

                                                        <a class="btn btn-primary" href="{{route('facture.edit',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Modifier
                                                        </a>
                                                        <a class="btn btn-primary" href="{{route('payment.facture',['facture'=>$facture->id])}}">
                                                            Paiments
                                                        </a>

                                                    </td>

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






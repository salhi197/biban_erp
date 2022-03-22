@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Tables des factures | Camions</h4>
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
													<th class="border-bottom-0">ID référence</th>
													<th class="border-bottom-0">Total </th>
                                                    <th class="border-bottom-0">crée le</th>
													<th class="border-bottom-0">Actions</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($factures as $facture)
												<tr>
													<td>
                                                    {{$facture->getFournisseur()['nom'] ?? ''}}
                                                    {{$facture->getFournisseur()['prenom'] ?? ''}}
                                                    
                                                    </td>
													<td>{{$facture->totalht ?? ''}}</td>
													<td>{{$facture->created_at ?? ''}} </td>
													<td>
                                                        <a class="btn btn-primary" href="{{route('facture.show',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Ouvrir
                                                        </a>

                                                        <a href="{{route('facture.download',['facture'=>$facture->id])}}" class="text-white btn btn-primary" id="x">
                                                                <i class="fa fa-download"></i> Télécharger
                                                            </a>

                                                        <a class="btn btn-primary" href="{{route('payment.facture',['facture'=>$facture->id])}}">
                                                             Payments
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






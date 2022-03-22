@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Tables des factures</h4>
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
                                                    <th class="border-bottom-0">Type</th>
													<th class="border-bottom-0">Total HT</th>
													<th class="border-bottom-0">TVA</th>
													<th class="border-bottom-0">Total</th>
													<th class="border-bottom-0">crée le</th>
													<th class="border-bottom-0">Actions</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($factures as $facture)
												<tr>
                                                <td>{{$facture->id ?? ''}}</td>
                                                <td>{{$facture->type ?? ''}}</td>
													<td>{{$facture->totalht ?? ''}}</td>
													<td>{{$facture->tva ?? ''}}</td>
													<td>{{$facture->adress ?? ''}} - {{$facture->ville ?? ''}}</td>
													<td>{{$facture->created_at ?? ''}} </td>
													<td>
                                                        <a class="btn btn-primary" href="{{route('facture.open',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Ouvrir
                                                        </a>

                                                        <a class="btn btn-primary" href="{{route('facture.open',['facture'=>$facture->id])}}">
                                                            <i class="fa fa-open"></i> Voir Attachement
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






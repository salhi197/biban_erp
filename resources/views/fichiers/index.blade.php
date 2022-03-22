@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Fichiers</h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">Fichiers</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-2" class="table table-bordered key-buttons text-nowrap" >
											<thead>
												<tr>
													<th class="border-bottom-0">ID Fichier </th>
													<th class="border-bottom-0">Type</th>
													<th class="border-bottom-0">Date D'Importation</th>
													<th class="border-bottom-0">Actions</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($fichiers as $fichier)
												<tr>
													<td>{{$fichier->id ?? ''}}</td>
													<td>
                                                    <span class="badge badge-success">{{$fichier->type ?? ''}}</span>
                                                    </td>
                                                    <td>{{$fichier->created_at ?? ''}}</td>

													<td>
                                                        <a class="btn btn-primary" href="{{asset($fichier->path)}}">
                                                            <i class="fa fa-folder-open"></i> Ouvrir
                                                        </a>
                                                        <a class="btn btn-primary" href="{{route('fichier.delete',['fichier'=>$fichier->id])}}">
                                                            <i class="fa fa-trash"></i> Supprimer
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






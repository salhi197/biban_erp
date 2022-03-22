@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h4 class="page-title">Table des Chauffeurs</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Chauffeurs</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="text-white btn btn-primary" href="{{route('fournisseur.show.create')}}">
                    <i class="fa fa-plus"></i> Nouveau Chauffeur
                </a>
                &nbsp;
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Affecter Matricule
                </button>
                &nbsp;
                <!-- <a class="btn btn-primary" href="{{route('camion.index')}}">
                                        Chercher Camion
                                    </a> -->
                &nbsp;
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSms">
                                        S.M.S
                                    </button> -->
            </div>



            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-2" class="table table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">ID </th>
                                <th class="border-bottom-0">Nom</th>
                                <th class="border-bottom-0">Prénom</th>
                                <th class="border-bottom-0">Téléphone</th>
                                <th class="border-bottom-0">RIB</th>
                                <th class="border-bottom-0">Adresse</th>
                                <th class="border-bottom-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fournisseurs as $fournisseur)
                            <tr>
                                <td>{{$fournisseur->id ?? ''}}</td>
                                <td>{{$fournisseur->nom ?? '' }}</td>
                                <td>{{$fournisseur->prenom ?? '' }}</td>
                                <td>{{$fournisseur->telephone ?? '' }}</td>
                                <td>{{$fournisseur->rib ?? '' }}</td>
                                <td>{{$fournisseur->adress ?? '' }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('fournisseur.edit',['fournisseur'=>$fournisseur->id])}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalsMatricules{{$fournisseur->id}}">
                                        Voir Matricules
                                    </button>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPapiers{{$fournisseur->id}}">
                                        Voir Papiers
                                    </button>

                                    <a class="btn btn-danger text-white" href="{{route('fournisseur.destroy',['fournisseur'=>$fournisseur->id])}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <div class="modal fade" id="modalPapiers{{$fournisseur->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Papier du Chauffeur</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach($fournisseur->papiers() as $key=>$papier)
                                                    <img src="{{asset("img/permis.jpg")}}" width="300px" />

                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalsMatricules{{$fournisseur->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Matricules</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <select class="form-control" size="5">
                                                        @foreach($fournisseur->matricules() as $key=>$matricule)
                                                        <option value="">{{$matricule->matricule}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



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

@section('modals')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Affecter un matricule à un client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('fournisseur.affecter')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Client : </label>
                        <select class="form-control" name="fournisseur" size="5">
                            <option value="">Client ... </option>
                            @foreach($fournisseurs as $key=>$fournisseur)
                            <option value="{{$fournisseur->id}}">{{$fournisseur->nom}} {{$fournisseur->prenom}}</option>
                            @endforeach
                        </select>
                        <a class="{{route('fournisseur.show.create')}}">Nouveau Client</a>


                    </div>


                    <label class="form-label">Matricule : </label>
                    <input type="text" class="form-control" name="matricule" value="{{$facture->id ?? ''}}">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>

                </form>
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="modalSms" tabindex="-1" role="dialog" aria-labelledby="modalSmsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSmsLabel">Enovyer Sms :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('send.sms')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Client : </label>
                        <select class="form-control fournisseurs-multiple-sms" style="width: 75%" name="fournisseur">
                            <option value="">Client ... </option>
                            @foreach($fournisseurs as $key=>$fournisseur)
                            <option value="{{$fournisseur->id}}">{{$fournisseur->nom}} {{$fournisseur->prenom}}</option>
                            @endforeach
                        </select>
                    </div>


                    <label class="form-label">Text : </label>
                    <textarea name="contenu" class="form-control">

            </textarea>
                    <br>


                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>

                </form>
            </div>
        </div>
    </div>
</div>



@endsection
@section('styles')
<!-- TIME PICKER CSS -->
<link href="{{asset('assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet" />
<!-- DATE PICKER CSS -->
<link href="{{asset('assets/plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
<style>
    .dataTables_filter {
        width: 50%;
        float: left;
    }
</style>

@endsection

@section('scripts')
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<script>
    $(document).ready(function() {

        $('.fournisseurs-multiple').select2();
        $('.fournisseurs-multiple-sms').select2({
            width: 'resolve' // need to override the changed default
        });

        $("#generate").on('click', function(e) {
            e.preventDefault()
            console.log('te')
            $('#formgenerate').submit(); //('test');
        });

        $("#filter").on('click', function(e) {
            e.preventDefault()
            $('#formfilter').submit(); //('test');
        });


    });
</script>
@endsection
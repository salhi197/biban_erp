@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Les Statistiques</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">ToTla Chauffeurs</h5>
                                    <p class="card-text"></p>
                                    <a href="#" class="btn btn-primary">---</a>
                                </div>
                            </div>                    
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Nombre Sms Envoyé</h5>
                                    <p class="card-text"></p>
                                    <a href="#" class="btn btn-primary">---</a>
                                </div>
                            </div>                    
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Total Chauffeurs dans ce mois</h5>
                                    <p class="card-text"></p>
                                    <a href="#" class="btn btn-primary">---</a>
                                </div>
                            </div>                    
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Solde Sms</h5>
                                    <p class="card-text"></p>
                                    <a href="#" class="btn btn-primary">---</a>
                                </div>
                            </div>                    
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
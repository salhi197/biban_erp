@extends('layouts.admin')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">

                                    <div class="card-header"><h3 class="font-weight-light my-4">nouveau Personnel  </h3></div>

                                    <div class="card-body">

                                        <form method="post" action="{{route('user.create')}}">

                                        @csrf

                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">nom et prenom: </label>
                                                        <input type="text" value="{{ old('nom_prenom') }}" name="nom_prenom"  class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">

                                                        <label class="small mb-1" >Login</label>
                                                        <input  class="form-control" value="{{ old('email') }}" name="email" id="email" type="text" placeholder="" />

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">mot de passe : </label>
                                                        <input  class="form-control" value="{{ old('password') }}" name="password" id="email" type="text" placeholder="" />
                                                    </div>

                                                </div>


                                            </div>


                                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">Ajouter</button></div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>





@endsection





@section('scripts')

<script>

function watchWilayaChanges() {

            $('#wilaya_select').on('change', function (e) {

                e.preventDefault();

                var $communes = $('#commune_select');

                var $communesLoader = $('#commune_select_loading');

                var $iconLoader = $communes.parents('.input-group').find('.loader-spinner');

                var $iconDefault = $communes.parents('.input-group').find('.material-icons');

                $communes.hide().prop('disabled', 'disabled').find('option').not(':first').remove();

                $communesLoader.show();

                $iconDefault.hide();

                $iconLoader.show();

                $.ajax({

                    dataType: "json",

                    method: "GET",

                    url: "/api/static/communes/ " + $(this).val()

                })

                    .done(function (response) {

                        $.each(response, function (key, commune) {

                            $communes.append($('<option>', {value: commune.id}).text(commune.name));

                        });

                        $communes.prop('disabled', '').show();

                        $communesLoader.hide();

                        $iconLoader.hide();

                        $iconDefault.show();

                    });

            });

        }



        $(document).ready(function () {

            watchWilayaChanges();

        });

</script>

@endsection
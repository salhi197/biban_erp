@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">Envoyer Sms </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">Camions</li>
						</ol>
					</div>

                    <div class="row">
						<div class="col-md">
							<div class="card overflow-hidden">
                                <form class="card" action="{{route('send.sms')}}" method="post">
                                    @csrf
                                    <div class="card-header">
                                        <h3 class="card-title">Envoyer Sms : </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Numéro de téléphone : </label>
                                                    <select class="form-control js-example-basic-single" name="telephone" >
                                                        @foreach($fournisseurs as $fournisseur)
                                                            <option value="{{$fournisseur->telephone}}">{{$fournisseur->telephone}}</option>
                                                        @endforeach
                                                    </select>

                                                    <!-- <input type="text" class="form-control" placeholder="Téléphone e.g: 0648-75-25-14" 
                                                    name="telephone"
                                                    > -->
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Matricule</label>
                                                    <select class="form-control js-example-basic-single" name="matricule">
                                                        <option value="1">23456789</option>
                                                        <option value="2">876544</option>
                                                        <option value="3">345679886754</option>
                                                        <option value="4">987654345</option>
                                                        <option value="5">2534678768</option>
                                                        <option value="6">457077967</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card shadow">
                                                    <div class="card-header">
                                                        <h3 class="mb-0 card-title">Contenu de Sms :  </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <textarea name="text" type="text" class="form-control"  data-height="100%" width="100%" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" id="smsSend" class="btn btn-primary">Envoyer</button>
                                    </div>
                                </form>
							</div>
						</div><!-- COL END -->
					</div>



@endsection




@section('scripts')
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });            
            // toastr.success('sa')
                // swal(title, message);                        



                // fetch('',{
                //     headers: {
                //         "Content-Type": "application/json",
                //         "Accept": "application/json",
                //         "X-Requested-With": "XMLHttpRequest",
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     method: "get",
                //     credentials: "same-origin",
                // })
                //     .then(data => {
                //         console.log("test");
                //     })                
                //     .catch(err =>{
                //         console.log(err);
                //     });
    

</script>
@endsection


@extends('layouts.admin')

@section('content')

                    <div class="page-header">
						<h4 class="page-title">
                            Tables FDRs
                        </h4>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Accueil</a></li>
							<li class="breadcrumb-item active" aria-current="page">FDRs</li>
						</ol>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
                                    <button type="button" class="btn btn-primary" onclick="scanToJpg();">
                                        <i class="fa fa-plus"></i> Scanner 
                                    </button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Ajouter Image sans Scan
                                    </button>


								</div>

								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-5" class="table table-bordered  text-nowrap" >
											<thead>
                                                <tr>
                                                    <th class="border-bottom-0">
                                                    </th>
                                                    <th class="border-bottom-0">Id</th>
                                                    <th class="border-bottom-0">Numero feuile de route</th>
                                                    <th class="border-bottom-0">creé le</th>                                                    
                                                    <th class="border-bottom-0">actions</th>
                                                </tr>
											</thead>
											<tbody>
                                            @foreach($fdrs as $key=>$fdr)
												<tr>
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                        <label for="vehicle1"> séléctionner</label><br>
                                                    </td>
                                                    <?php $index = $key+1; ?>
                                                    <td>{{$index ?? '' }}</td>
                                                    <td>{{$fdr->titre ?? '' }}</td>
                                                    <td>                                                    
                                                    {{ Carbon\Carbon::parse($fdr->date_fdr)->format('Y-m-d') }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger" href="{{route('fdr.destroy',['fdr'=>$fdr->id])}}" 
                                                        onclick="return confirm('Are you sure?')"
                                                        >
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <a  class="btn btn-primary" download href="{{'/storage/app/public/'.$fdr->path}}" >télécharger</a>
                                                        <a  class="btn btn-primary" href="{{'/storage/app/public/'.$fdr->path}}" >ouvrir</a>


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
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter feuille de route</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('fdr.create')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="form-label">Num feuille de route :  </label>
                                                            <input type="text" class="form-control" 
                                                            name="titre"
                                                            >


                                                            <label class="form-label">Feuille de route  :  </label>
                                                            <input type="file" class="form-file" 
                                                            name="fdr"
                                                            >
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                    </form>

                                                </div>
                                                </div>
                                            </div>
                                        </div>





@endsection

@section('header-script')
<script src="{{asset('js/scannerjs/scanner.js')}}" type="text/javascript"></script>
<script>
        //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Initiates a scan */
        function scanToJpg() {
            scanner.scan(displayImagesOnPage,
                    {
                        "output_settings": [
                            {
                                "type": "return-base64",
                                "format": "jpg"
                            }
                        ]
                    }
            );
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if(!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                console.info('User cancelled');
                return;
            }

            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                processScannedImage(scannedImage);
            }
        }

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            document.getElementById('images').appendChild(elementImg);
        }

    </script>
@endsection

@section('styles')
<style>
        img.scanned {
            height: 200px; /** Sets the display size */
            margin-right: 12px;
        }

        div#images {
            margin-top: 20px;
        }
</style>
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
<script>
$(document).ready(function() {
    $( "#generate" ).on('click',function(e){
        e.preventDefault()
        console.log('te')
        $('#formgenerate').submit();//('test');
    });

    $( "#filter" ).on('click',function(e){
        e.preventDefault()
        $('#formfilter').submit();//('test');
    });


});
</script>
@endsection

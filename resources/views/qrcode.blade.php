<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Algematic</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{asset('css/ticket.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <?php $doc = '/storage/app/public/file_'.$qrcode.'.pdf'; ?>

        <iframe  id="pdf" name="pdf" src="{{$doc}}"
            style="display:none"
        ></iframe>

        <div class="flex-center position-ref full-height">
                <div class="top-right links">
                    <a class="btn btn-info" 
                    style="cursor:pointer;"
                    id="print">Imprimer</a>
                    <a href="/">
                        <img src="{{asset('img/algematic.png')}}" width="50px"/>
                    </a>

                </div>
                <div class="content">
                  <div id="" class="ticket">
                    <div class="ticket-header">
                      <div class="ticket-logo">
                        <img src="{{asset('img/ticket-imag.png')}}" class="ticket-logo-image" alt="">
                      </div>
                    </div>
                    <div class="ticket-body">
                      <div class="ticket-airports info-container">
                        <div class="ticket-airport-depart" >
                          <span class="ticket-airport-departName detail" style="align:center;"><?php echo date('Y-m-d H:i:s');
                            ?></span>
                        </div>
                      </div>
                      <div class="ticket-flightDetails info-container">
                        <div class="ticket-flightNumber">
                          <span class="ticket-flightNumberDetail detail" >Rencontres Equipe Nationale</span>
                        </div>
                      </div>
                      <div class="ticket-seats info-container">
                        <div class="ticket-class" style="justify-content:center;" >
                          <span class="ticket-className detail" style="text-align:center;">ALGERIE - ZIMBABWE</span>   
                        </div>
                      </div> 
                      <div class="qrcodecontainer">
                        <div class="qrcode-child">
                            <span class="ticket-className detail" >Place : A002</span>
                            <span class="ticket-className detail" >Zone:10</span>                           
                        </div>
                        <div class="qrcode-qrcode">
                            <?php $path = "/storage/app/public/qrcodes/".$qrcode.".svg";?>
                            <img src="{{$path}}"  alt="QR Code">
                        </div>
                        <div class="qrcode-child">
                            <span class="ticket-className detail">Billet : 197</span>
                            <span class="ticket-className detail">Abdeljilali Soal</span>                           
                        </div>
                      </div>
                    </div>  
                    <div class="ticket-footer"></div>  
                  </div>  




                </div>
        </div>

        <script src="{{asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/printThis.js')}}"></script>
        <script>
                function isLoaded()
                {   
                }
            $(function(){
                $('#print').on('click',function(){
                    var pdfFrame = window.frames["pdf"];
                    pdfFrame.focus();
                    pdfFrame.print();

                })
            })
        </script>



    </body>
</html>


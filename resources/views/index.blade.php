<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zain Wifi</title>

        <script type='text/javascript' src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>

        <script type='text/javascript' src="{!! asset('js/bootstrap.min.js') !!}"></script>

        <link id="default-css" href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet" media="all" />

        <link id="default-css" href="{!! asset('css/font-awesome.min.css') !!}" rel="stylesheet" media="all" />
        <link href="{!! asset('lightbox/ekko-lightbox.css') !!}" rel="stylesheet">
        @if(isset($notAllow))
        <style>

            .modal-header
            {
                background:#3E244A;
                color:white;
            }
            .btn-default
            {
                background:#3E244A;
                color:white;
            }
            .centered-modal.in {
                display: flex !important;
            }
            .centered-modal .modal-dialog {
                margin: auto;
            }


        </style>
        @endif
    </head>
    <body >

    <div class="container">

    <a href="{{url('zain/verify')}}">

        <img   data-toggle="lightbox"  class="text-center" style="width: 100%; margin-top: 10px; margin-bottom: 10px;" src="{!! asset('images/zain_wifi.jpg') !!}">
    </a>
        <a style="display:none " id="popup"   href="{!! asset('images/spinner.gif') !!}" data-max-width="600">
            <img  src="{!! asset('images/spinner.gif') !!}" class="img-fluid">
        </a>

    </div>

    @if(isset($notAllow))
    <button style="display:none" type="button" id = "watchButton"  data-toggle="modal" data-target="#myModal"></button>

    <div id="myModal" class="modal fade centered-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Notification!</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: center !important;">Enjoy one hour of free internet after 24 hours.</p>
                    <p style="text-align: center !important;">.أستمتع بساعة مجانية اخرى بعد 24 ساعة </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    @endif

    </body>
    @if(isset($notAllow))
<script>
    $(function() {
        $('#watchButton').click();
    });
</script>


   @endif
    <script src="{!! asset('lightbox/ekko-lightbox.js') !!}"></script>
    <script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {

        $('#popup').ekkoLightbox(
            {
                backdrop: 'static',
                keyboard: false,

            }
        );

    });










</script>
</html>

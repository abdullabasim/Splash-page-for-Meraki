<!doctype html>
<html >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zain Wifi</title>

        <style>
            body {
                background: url('{!! asset('images/background.png') !!}') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>

        <script type='text/javascript' src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>

        <script type='text/javascript' src="{!! asset('js/bootstrap.min.js') !!}"></script>

        <link id="default-css" href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet" media="all" />

        <link id="default-css" href="{!! asset('css/font-awesome.min.css') !!}" rel="stylesheet" media="all" />

    </head>

    <body  >

    @if( empty($phoneNumber))

        {!!  redirect('/') !!}
        @endif
    <div >

        <div class="container">

            <div  style="margin-top:180px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                <div style="border: 2px solid white;border-radius: 8px;">
                <div style="display:none"  class="alert alert-danger col-sm-12"></div>

                <form class="form-horizontal" role="form" method="post" action ="{{url('/zain/verify/step2')}}">
                   <div style="margin-top:4px;margin-left: 5px;margin-right:5px">

                    @include('alertNotifications/alertNotifications')
                    {{csrf_field()}}
                    @if (isset($error) )
                        <div id="alert_message" class="alert alert-danger alert-block">
                            <strong>{{ $error }}</strong>
                        </div>
                    @endif

                   </div>
                    <div style="text-align: center;color: white">
                        <h3 style="margin-bottom: -4px">أدخل الرمز السري</h3>
                        <h4>Enter Verification Code</h4>
                    </div>
                    <input type="hidden" name="phone_number" value="{{$phoneNumber}}">

                    <div style="margin-top:10px;margin-left: 3px;margin-right:3px;margin-bottom: -10px " class="form-group">

                        <div class="col-sm-12 controls text-center" >
                        <input  type="text" class="form-control" name="verify_code" value="" >
                    </div>
                    </div>
                    <br>
                    <div style="margin-left: 3px;margin-right:3px" class="form-group">

                        <div class="col-sm-12 controls text-center" >
                            <input  style="background-color: #DE0184;border-color: #ffffff;" type="submit" value="OK"   class="btn btn-primary btn-block">

                        </div>
                        <div class="col-sm-12 controls text-center " >
                            <p style="margin-top:5px;color: white">تمتع بساعة انترنت مجانية مع زين </p>
                        </div>
                        <div class="col-sm-12 controls text-center " >
                            <p style="margin-top:-10px;color: white">Enjoy 1 hour free internet from Zain</p>
                        </div>
                    </div>

                </form>
                    <div  class="form-group">
                        @if (isset($sendAgain))
                            <br>
                            <div style="float:right;margin-right: 30px; font-size: 100%; position: relative; top:-10px ;">
                                <form id="myforms" method="post" action="{{url('/zain/sendagain')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="phone_number" value="{{$phoneNumber}}">
                                    <a  style="color: white" href="#" onclick="document.getElementById('myforms').submit()">Send Code Again</a>
                                </form>
                            </div>
                            <br>

                        @endif
                    </div>
                </div>
        </div>
    </div>
    </div>
    <div style="background-color: black" class="navbar navbar-fixed-bottom text-center"><span style="color: #2ab27b"><b>{{date("Y")}} &copy; Zain Iraq</b></span></div>

    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IVN</title>
    <!-- Styles -->
    <link rel="stylesheet" media="screen" href="{{asset('css/bootstrap_admin.min.css?v=1')}}" />
    <link rel="stylesheet" media="screen" href="{{asset('css/jquery-ui.css?v=1')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    @yield('css')
    <script type="text/javascript" src="{{asset('js/jquery-1.10.2.min.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/common.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.bootstrap.min.js?v=1')}}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = "{{url('/home')}}"; 
    </script>
</head>
    <body>
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <div class="clearfix"></div>
            <div id="container">
                <div id="header">            
                    @include('layouts.login.header')
                </div>
                <div class="clearfix"></div>
                <div id="content">
                    @include('layouts.login.flashmessage')
                    @yield('content');
                </div>
                <div class="clearfix"></div>               
            </div>            
        </div>
        @yield('scripts')
        <script type="text/javascript">
            
            hideModal = function(selector) {
                jQuery(selector).modal('hide');
            }
            jQuery("body").on("hidden.bs.modal", ".modal", function() {
                $(this).removeData("bs.modal");
            });
            jQuery(document).ajaxStart(function() {
                jQuery("#overlay").fadeIn();
            }).ajaxStop(function() {
                jQuery("#overlay").fadeOut();
            });
        </script>    
            
    </body>
</html>
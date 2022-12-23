<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo !empty($title_for_layout) ? $title_for_layout:'ivn'; ?></title>
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}" type="image/x-icon">
    <?php
        if (isset($description_for_layout)) {
            echo "<meta name='description' content='" . $description_for_layout . "' />";
        }
    ?>
    <?php
        if (isset($keywords_for_layout)) {
            echo "<meta name='keywords' content='" . $keywords_for_layout . "' />";
        }
    ?>
    <?php if (isset($meta_title_content)) { ?>
            <meta property="og:title" content="<?php echo $meta_title_content; ?>"/>
    <?php } ?>

     <!-- Bootstrap core CSS -->
    <link href="{!! asset('css/bootstrap.min.css')!!}" rel="stylesheet">
    <link href="{!! asset('css/cookie.css')!!}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{!! asset('css/ie10-viewport-bug-workaround.css')!!}" rel="stylesheet">

     <!--animate -->
    <link href="{!! asset('css/animate.min.css')!!}" rel="stylesheet" type="text/css">
     <!-- Custom styles for this template -->
    <link href="{!! asset('css/ivn-theme.css')!!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('css/responsive.css')!!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('css/bootstrap-tagsinput.css')!!}" rel="stylesheet" type="text/css">

    <link href="{!! asset('libs/font-awesome/css/font-awesome.min.css')!!}" rel="stylesheet" type="text/css">
     <!-- font families -->
    

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="{{asset('css/chosen.min.css?v=1')}}" />
    
    
    <!-- Bootstrap core JavaScript === -->
    <script src="{!! asset('js/jquery-3.2.1.min.js')!!}"></script>
    <script src="{!! asset('js/bootstrap.min.js')!!}"></script>
    <script src="{!! asset('js/bootstrap-tagsinput.js')!!}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{!! asset('js/ie10-viewport-bug-workaround.js')!!}"></script>


    <!-- Bootstrap core JavaScript === -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <?php if(!Auth::user()){ ?>
        <link rel="stylesheet" href="{!! asset('css/home_page_style.css')!!}">
        <link rel="stylesheet" href="{!! asset('css/owl.carousel.css')!!}">
        <link rel="stylesheet" href="{!! asset('css/owl.theme.default.min.css')!!}">
        <script type="text/javascript" src="{!! asset('js/owl.carousel.js')!!}"></script>
    <?php }else if(!empty($title) && $title == 'home'){ ?>
        <link rel="stylesheet" type="text/css" href="{!! asset('libs/slick/slick.css')!!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('libs/slick/slick-theme.css')!!}"/>
        <script type="text/javascript" src="{!! asset('libs/slick/slick.min.js')!!}"></script>
    <?php } ?>


    <script src="{!! asset('libs/wow/wow.min.js')!!}"></script>
    <!-- Scrolling Nav JavaScript -->
     <script src="{!! asset('js/jquery.easing.min.js')!!}"></script>
    <!-- custom js -->
    <script src="{!! asset('js/main.js')!!}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="{{asset('js/editor1.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-22368804-4', 'auto');
        ga('send', 'pageview');
    </script>
    
    <script type="text/javascript">
        function sendbuttonTrack(cat,action,labal){
          ga( 'send', 'event', 'button Click', 'submit' );
        }
        function sendbuttonTrack1(cat,action,labal){  
          ga('send', 'event', { eventCategory: cat, eventAction: action, eventLabel: labal});
        }

        function trackNavigate(eventName,url){
               sendbuttonTrack1('Tilmeldinger','tilmelding',eventName);
               setTimeout("navigate('"+url+"')",2000);
        }

        function navigate(url){
            window.location = url;
        }
    </script>

</head>
<body>
    <input id="crf_token" value="{{ csrf_token() }}" type="hidden">
    <!-- Wrapper-->
    
    <!-- Navigation -->
    @include('layouts.default.header')
    <!-- @include('layouts.default.flashmessage') -->
    @include('layouts.default.bannerImageSlider')
    <!-- Page wraper -->
    <div>
        <!-- Page wrapper -->
        <!-- Main view  -->
        @yield('content')
        
    </div>
    <!--footer -->   
    @if(!Session::has('cookie'))
        <div class="cookie-bar">
            <span>
                <?php echo cmskey('cookie_text');?>
                <a href="javascript:;" style="text-decoration: underline;" data-target="#cookie_term" onclick="$('#cookie_term').modal('show');">
                    <?php echo  cmskey('cookie_link_text'); ?>
                </a>                    
            </span>
            <label for="checkbox-cb" onclick="removeCookie()" class="close-cb"><?php echo  cmskey('cookie_button'); ?></label>
        </div>

        <!-- popups -->
        <div class="modal fade ivn-popups" id="cookie_term" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md " role="document">
                <div class="vm-layout">
                    <div class="vm-layout-content">
                        <div class="vm-padding">
                            <div class="modal-content style-black no-border-radius no-shadow no-border no-padding-top ">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                                    <img src="{{asset('images/white_close.png')}}" alt="close">
                                </button>
                                <div class="modal-body ">
                                    <div class="body-with-scroll">
                                        <div class="col-lg-10 col-lg-offset-1 clear-before-after text-white">
                                           <h2 class="text-white"><?php echo cmskey('cookie_popup_title');?></h2>
                                           <style type="text/css">
                                           .modal-body .text-white p,.modal-body .text-white label{
                                            color: #fff !important;
                                            font-size: 14px;
                                           } 

                                           .modal-body .text-white .table-striped>tbody>tr:nth-of-type(odd) {
                                                 background-color: #333; 
                                            }

                                            .modal-body .text-white p,.modal-body .text-white label{
                                                color: #fff !important;
                                           }
                                           </style>
                                            <div class="text-white"><?php echo cmskey('cookie_popup_details');?></div>
                                        </div>                          
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endif
    
    <!--footer -->
    <!-- End page wrapper-->
    @include('layouts.default.footer')
<!-- End wrapper-->
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript">
    @if(!Session::has('cookie'))
    function removeCookie(){
        $.ajax({
          url: "{{url('cookie')}}",
          type: "get",
          data: {},
          success: function(data){
            if(data.trim() == 'true'){
                $('.cookie-bar').hide();
            }
          }
        });
    }
    @endif

    <?php if(Auth::user()){?>
    function submitPost(){
        var ext = $('#fileChooser').val().split('.').pop().toLowerCase();
        if($('#fileChooser').val() != ''){
            if(!($.inArray(ext, ['gif','jpg','jpeg','pjpeg','bmp','png']) == -1)){
                $('#post').submit();
            }else{
                alert("<?php echo cmskey('not_valid_extention');?>");
            }
        }else{
            $('#post').submit();
        }

        return false;
    }
    $(document).ready(function(){
        $('.chosen-select').chosen({width: '55%'} );
        options = {
                rules: {
                    "title": "required",
                    'details':'required',
                    'network_id[]':"required",
                },
                messages: {
                    "title": "Indtast venligst en titel",
                    "details": "Indtast venligst en tekst",  
                    'network_id[]':"Vælg venligst et netværk",
                }
            };
            $.validator.setDefaults({ ignore: ":hidden:not(select)" });
            $('#post').validate( options );
    });
    <?php } ?>
</script>
@section('scripts')
@show

</body>
</html>

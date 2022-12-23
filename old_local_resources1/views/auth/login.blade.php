@extends('layouts.default.app')
@section('content')
<div class="content-area-full register-login-area bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-form">
                        <div class="col-lg-12">
                            <h2 class="pg-heading">
                                Log ind
                            </h2>
                            <div class="grayBox">
                                <form class="form-horizontal" id="login" method="POST" action="{{ route('login') }}">                                    
                                        {{ csrf_field() }}
                                        <div class="clearfix col-md-12">
                                            <h3 style="color:white;">Log ind</h3>
                                        </div>
                                        <div class="field-box">
                                            <label>E-mail*:</label>
                                            <div class="field-ctnt">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <label id="email-not_exist" class="error" for="email-not_exist">{{ $errors->first('email') }}</label>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="field-box">
                                            <label>Adgangskode*:</label>
                                            <div class="field-ctnt">
                                                <input id="password" type="password" class="form-control" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="clearfix">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12">
                                                    <input type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','Login')" name="" value="Log ind" class="btn btn-primary btnSubmt">
                                                </div>
                                            </div>
                                        </div>
                                    
                                </form>
                                <div class="clearfix"></div>

                                <div class="or clearfix">
                                    <div class="link-forgort-password">
                                        <a data-target-url="{{route('password.request')}}" style="color:white;text-decoration:underline;" href="javascript:;" data-toggle="modal" data-target="#popup-forgot-password"  title="Forget password">Glemt dit password?</a>
                                    </div>
                                </div>
                               
                                <div class="or" style="display:none;">eller</div>

                                <div class="clearfix" style="display:none;">
                                    <div class="fancy-checkbox style-white">
                                        <input type="checkbox" name="confirm" value="1" class="checkbox" id="checkbox-1" onchange="changeStatus()">
                                        <label for="checkbox-1" class="checkbox-click-target" style="color:white;"><span class="checkbox-box"></span>
                                            Ja tak, jeg vil gerne være medlem, og accepterer samtidig IVN’s <a href="javascript:;" style="color:white;text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">brugerbetingelser.</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="clearfix" style="display:none;"></div>
                                
                                <div class="signup-with-fb" style="display:none;">
                                    <a disabled="disabled" href="#" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','ProfileCreationFacebook');" id="fbook" data-toggle="tooltip" data-placement="top" title="Du skal acceptere brugerbetingelserns for at kunne oprette dig som bruger på IVN." class="btn btn-priamry btnSubmt btn-inline-block btn-text-white">
                                        Log in med Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popups -->
<div class="modal fade ivn-popups" id="popup-forgot-password" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md " role="document">
        <div class="vm-layout">
            <div class="vm-layout-content">
                <div class="vm-padding">
                    <div class="modal-content style-black no-border-radius no-shadow no-border no-padding-top ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{url('images/white_close.png')}}" alt="close">
                        </button>
                        <div class="modal-body">
                            
                        <div class="col-lg-10 col-lg-offset-1">
                            <h2 class="text-white"><?php echo  cmskey('forget_password_header'); ?></h2>
                            <p class="text-center text-white" id="details"><?php echo  cmskey('forget_password_details'); ?></p>
                            <div class="pop-body">


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

<!-- popups -->
<div class="modal fade ivn-popups" id="term_and_condition" tabindex="-1" role="dialog">
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
                                   <h2 class="text-white"><?php echo cmskey('term_conditions_title');?></h2>
                                    <?php echo cmskey('term_conditions_details');?>
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

@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.form.js?v=1')}}"></script>
    <script type="text/javascript">
    function changeStatus(){
        if($('#checkbox-1').is(':checked')){
            
            $("#fbook").attr('onclick',"facebookLogin()").removeAttr('disabled');            
        }else{
            $("#fbook").removeAttr('onclick').attr('disabled','disabled');
        }
    }

    function facebookLogin(){
        trackNavigate('ProfileCreationFacebook','{{url('social/auth/redirect/facebook')}}');

    }


    $(document).ready(function(){
        $('body').addClass('bg-white');
        $("#popup-forgot-password").on("show.bs.modal", function(e) {
            url =  $(e.relatedTarget).data('target-url');
            $.get( url , function( data ) {
                $(".pop-body").html(data);
            });
        });
        options = {
                rules: {
                    "email": {"required":true,"email":true},
                    'password':"required"
                },
                messages: {
                    "email": {"required":"Indtast venligst en e-mail adresse","email":"Indtast venligst en e-mail adresse"},
                    'password':"Indtast et kodeord"
                }
            };
            $('#login').validate( options );
    });
    </script>
@endsection
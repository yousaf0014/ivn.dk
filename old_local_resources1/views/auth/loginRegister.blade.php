@extends('layouts.default.app')
@section('content')
<style type="text/css">
.modal-content {
    border: 1px solid;
    border-radius: 0px;
}
.help-block{
    color:white;
}
label.error{
    width:100% !important;
    font-size: 12px !important;
}
</style>
<div class="register-login-area bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="desc font-md">
                                <div class="col-md-10 col-md-offset-1">
                                <?php echo cmskey('login_page_message'); ?>
                            </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 boxes m-h-520">
                            <form class="form-horizontal" id="add_user" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="grayBox">
                                    <div class="clearfix col-md-12">
                                        <h3>Opret profil</h3>
                                    </div>
                                    <div class="field-box">
                                        <label>Fornavn*:</label>
                                        <div class="field-ctnt">
                                            {!! Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) !!}
                                            <input type="hidden" name="action" id="action" value="SIGNUP">                                
                                            <div class="error-msg"></div>
                                        </div>
                                    </div>
                                    <div class="field-box">
                                        <label>Efternavn*:</label>
                                        <div class="field-ctnt">
                                            {!! Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) !!}
                                            
                                        </div>
                                    </div>
                                    <div class="field-box">
                                        <label>E-mail*:</label>
                                        <div class="field-ctnt">
                                            {!! Form::text('email', Input::old('email'), array('id'=>'email','class' => 'form-control')) !!}                                 
                                        </div>
                                    </div>
                                    <div class="field-box">
                                        <label>Adgangskode*:</label>
                                        <div class="field-ctnt">
                                            <input type="password" onkeypress="return avoidSpace(event)" name="password" id="password" value="" class="form-control">
                                            <div class="notice-field">Minimum otte tegn.</div>
                                        </div>
                                    </div>
                                    <div class="field-box">
                                        <label>Bekræft adgangskode*:</label>
                                        <div class="field-ctnt">
                                            <input type="password" onkeypress="return avoidSpace(event)" name="confirmed" value="" class="form-control">
                                            <div class="notice-field">Minimum otte tegn.</div>
                                        </div>
                                    </div>




                                    <div class="clearfix">
                                        <div class="">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="fancy-checkbox style-white">
                                                    <input type="checkbox" name="confirm" value="1" class="checkbox" id="checkbox-1" onchange="changeStatus()">
                                                    <label for="checkbox-1" class="checkbox-click-target"><span class="checkbox-box"></span>
                                                        Ja tak, jeg vil gerne være medlem, og accepterer samtidig IVN’s <a href="javascript:;" style="color:white;text-decoration: underline;" data-target="#term_and_condition" onclick="$('#term_and_condition').modal('show');">brugerbetingelser.</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="fancy-checkbox style-white">
                                                    <input type="checkbox" name="news_letter" value="1" class="checkbox" id="checkbox-2">
                                                    <label for="checkbox-2" class="checkbox-click-target"><span class="checkbox-box"></span>
                                                        Ja tak, tilmeld mig IVN’s nyhedsbreve. Jeg accepterer samtidig 
                                                        <a href="javascript:;" style="color:white;text-decoration: underline;" data-target="#newsletter_terms" onclick="$('#newsletter_terms').modal('show');"> betingelserne.</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix">
                                        <div class="col-xs-12">
                                            <div class="col-lg-12 signup-with-fb text-center">
                                                <input type="button" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','ProfileCreation');submitUserForm()" disabled="disabled" id="submit_button" value="Opret profil" class="btn btn-priamry btnSubmt btn-inline-block btn-text-white">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <div class="or full-block form-or style-white" style="display:none;">eller</div>
                                    <div class="signup-with-fb text-center" style="display:none;">
                                        <div id="fb_div">
                                            <a disabled="disabled" href="#"  data-toggle="tooltip" data-placement="top" title="Du skal acceptere brugerbetingelserns for at kunne oprette dig som bruger på IVN." class="btn btn-priamry btnSubmt btn-inline-block btn-text-white">
                                                Opret profil med Facebook
                                          </a>
                                        </div>
                                        <div id="fb_div1" style="display:none">
                                            <a  href="#" onclick="facebookLogin()"  class="btn btn-priamry btnSubmt btn-inline-block btn-text-white">
                                                Opret profil med Facebook
                                          </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 boxes m-h-520">
                            <form class="form-horizontal" id="login" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="grayBox">
                                    <div class="clearfix col-md-12">
                                        <h3>Log ind</h3>
                                    </div>
                                    <div class="field-box">
                                        <label>E-mail*:</label>
                                        <div class="field-ctnt">
                                            <input class="form-control" name="email" type="text">
                                            @if ($errors->has('email'))
                                                <label id="email-not_exist" class="error" for="email-not_exist">{{ $errors->first('email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="field-box">
                                        <label>Adgangskode*:</label>
                                        <div class="field-ctnt">
                                            <input id="password" onkeypress="return avoidSpace(event)" type="password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="">
                                            <div class="col-sm-7 col-xs-7">
                                                <div class="link-forgort-password">
                                                    <a data-target-url="{{route('password.request')}}" style="color:white;text-decoration:underline;" href="javascript:;" data-toggle="modal" data-target="#popup-forgot-password"  title="Forget password">Glemt dit password?</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-xs-5">
                                                <input type="submit" onclick="sendbuttonTrack1('Tilmeldinger','tilmelding','Login');" name="" value="Log ind" class="btn btn-primary btnSubmt">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div> 
                            </form>   
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
<div class="modal fade ivn-popups" id="newsletter_terms" tabindex="-1" role="dialog">
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
                                   <h2 class="text-white"><?php echo cmskey('newsletter_title');?></h2>
                                    <?php echo cmskey('newsletter_details');?>
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
<script type="text/javascript" src="{{asset('js/popper.min.js?v=1')}}"></script> 
<script type="text/javascript">
    function changeStatus(){
        if($('#checkbox-1').is(':checked')){
            $('#submit_button').removeAttr('disabled');
            //$("#fbook").attr('onclick',"facebookLogin()").removeAttr('disabled');            
            $("#fb_div").hide();
            $("#fb_div1").show();
        }else{
            $('#submit_button').attr('disabled','disabled');
            //$("#fbook").removeAttr('onclick').attr('disabled','disabled');
            $("#fb_div").show();
            $("#fb_div1").hide();
        }
    }

    function facebookLogin(){
        trackNavigate('ProfileCreationFacebook','{{url('social/auth/redirect/facebook')}}');

    }
    $(document).ready(function(){
        
        $('[data-toggle="tooltip"]').tooltip();
        changeStatus();
        $("#popup-forgot-password").on("show.bs.modal", function(e) {
            url =  $(e.relatedTarget).data('target-url');
            $.get( url , function( data ) {
                $(".pop-body").html(data);
            });
        });
        options = {
                rules: {
                    'password':"required",
                    "email":{'required':true,'email':true}
                },
                messages: {
                    'password':"Indtast et kodeord",
                    "email": {"required":"Indtast venligst en e-mail adresse","email":"Indtast venligst en e-mail adresse"}
                    
                }
            };
            $('#login').validate( options );

        optionsForget = {
            rules: {
                "email":{'required':true,'email':true}
            },
            messages: {
                "email": {"required":"Indtast venligst en e-mail adresse","email":"Indtast venligst en e-mail adresse"}
            }
        }
        options2 = {
                    rules: {
                        "first_name": {"required":true,'minlength':2,'maxlength':18},
                        "last_name": {"required":true,'minlength':2,'maxlength':18},
                        "email"     :{
                            'required':true,
                            'email':true
                        },
                        "password": {
                            "required":true,
                            'minlength':8
                        } ,
                        "confirmed": {
                          "equalTo": "#password",
                          'minlength':8
                        }
                        
                    },
                    messages: {
                        "first_name": {"required":"Indtast venligst fornavn",'minlength':'Indtast minimum 2 bogstaver','maxlength':'Indtast mellem to og 18 bogstaver'},
                        "last_name": {"required":"Indtast venligst efternavn",'minlength':'Indtast minimum 2 bogstaver','maxlength':'Indtast mellem to og 18 bogstaver'},
                        "email"     :{ 
                            'required' : "Indtast venligst E-mail" , 
                            'email' : 'Indtast venligst en gyldig E-mail'
                        },
                        "password": {
                            "required":"Indtast password",
                            'minlength':"Minum længde er syv tegn"
                        },
                        "confirmed": {
                          "equalTo": "Password er ikke identiske",
                          'minlength':"Minum længde er syv tegn"
                        }
                        
                    }
                };
            $('#add_user').validate( options2 );
            $('#forgetpassword').validate(optionsForget);
    });
    
    function submitUserForm(){
        var flag = $('#add_user').valid();
        if(flag == true){
            if($('#checkbox-1').is(':checked')){
                var email = $( "#email" ).val();
                $.ajax({
                    url: "{{url('uniqeEmail')}}",
                    type: "get",
                    data: {email:email},
                    success: function(res){
                        if(res.trim() == 'true') {  //|| res.trim() == true || res.trim() == 1
                            $('#add_user').submit();
                        }else{
                            alert('<?php echo cmskey("email_already_in_use",true); ?>');
                        }
                    }
                });
            }else{
                //alert('<?php cmskey("agree_term_and_condition_error",true); ?>');
                return false;
            }
        }
        return false;
    }

    function avoidSpace(event) {
        var k = event ? event.which : window.event.keyCode;
        if (k == 32) return false;
    }
</script>
@endsection
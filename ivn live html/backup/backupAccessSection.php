<!--Access Section-->
<section class="light-grey tp-padding-30">

    <div class="container">    
      <div class="row">
        <!--Signup-->
        
        <div class="col-sm-12 col-lg-6">
                <div class="access-wrapper dark-grey">
                <form action="#" method="post" enctype="multipart/form-data">
                    <h1>Opret profil</h1>
                    <div class="sign-up-form">
                        <div class="row">
                            <div class="col-lg-5 col-xs-12">
                                <p>Fornavn*:</p>
                            </div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="text" class="form-control" id="first_name" name="first_name">
                                <input type="hidden" name="action" id="action" value="SIGNUP">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-5 col-xs-12">
                                <p>Efternavn*:</p>
                            </div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-5 col-xs-12">
                                <p>E-mail*:</p>
                            </div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-5">
                                <p>Adgangskode*:</p>
                            </div>
                            <div class="col-lg-7">
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="pull-right form-feedback" id="result">Minimum otte tegn.</small>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-5">
                                <p>Bekr&aelig;ft adgangskode*:</p>
                            </div>
                            <div class="col-lg-7">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                <small class="pull-right form-feedback" id="confirm_result">Minimum otte tegn.</small>
                                
                            </div>
                        </div>
                        <div class="row m-t-20">
                        	<div class="col-lg-7 col-xs-12">
          						 <div class="checkbox ivn-checkbox">
                                       <label>
                                            <input type="checkbox" value="" id="terms" checked>
                                            <span class="cr">
                                            <i class="cr-icon glyphicon glyphicon-ok"></i></span>Ja, jeg accepterer 
                                            <a href="#" data-toggle="modal" data-target="#terms-conditions" 
                                            data-keyboard="true">Brugerbetingelserne</a>
                                            <br>
                                            og at modtage nyhedsbreve fra IVN
                                            
                                      </label>
        						</div>
                            	
                        	</div>
                            <div class="col-lg-5 col-xs-12">
                            	<button type="submit" class="btn btn-primary col-lg-12">
                                	<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ja, opret profil</button>
                            </div>
                        </div>
                           
                    <div class="clearfix"></div>
                </div><!--/Signup-->
                </form>
        </div><!--access wrapper-->
        <!-- Modal -->

      </div> <!--/Signup--> 
        <!--Login-->
      
        <div class="col-sm-12 col-lg-6 mobile_margin_top">
        <div class="login_point" id="login"></div>
                <div class="access-wrapper dark-grey">
                
                    <h1>Login</h1>
                    <form action="#" method="post" enctype="multipart/form-data">
                    <div class="sign-up-form">
                        <div class="row m-t-20">
                            <div class="col-lg-5">
                                <p>E-mail*:</p>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" name="login_email" id="login_email">
                                
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <input type="hidden" name="action" id="action" value="SIGNIN"/>
                            <div class="col-lg-5">
                                <p>Adgangskode*:</p>
                            </div>
                            <div class="col-lg-7">
                                <input type="password" class="form-control" name="login_password" id="login_password">
                               <!--  <small class="pull-right form-feedback">Minimum otte tegn.</small>-->
                            </div>
                        </div>
                        <div class="row m-t-20">
                        	<div class="col-lg-9">
                            <p><small>
                            	<a href="#" data-toggle="modal" data-target="#forget-password">Glemt din adgangskode?</a></small>
                             </p>
                        	</div>
                            <div class="col-lg-3">
                            	<button type="submit" class="btn btn-primary col-lg-12">
                                	<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Login
                                </button>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-12 col-xs-12 text-center">
                                    
                                    <p>eller</p>
                                
                                    <?php 

                                        $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
                                            echo '<a href="'.htmlspecialchars($loginURL).'" class="btn btn-fb btn-fb col-xs-8 col-xs-offset-2">Login med Facebook</a>';
                                    ?>
                                    
                            </div>
                        </div>
                           
                    <div class="clearfix"></div>
                </div><!--/Signup-->
                </form>
        </div><!--access wrapper-->
      </div>
        <!--/Login-->
        
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section
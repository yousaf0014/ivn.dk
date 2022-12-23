<!--Access Section-->
<section class="light-grey tp-padding-30">

    <div class="container">    
      <div class="row">
        <!--Signup-->
        
        <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                <div class="access-wrapper dark-grey">
                    <h1>Ønsker du at flette din facebook-profil med IVN?</h1>
                     
                    <div class="sign-up-form">
                    <form action="#" method="post" name="ivn-fb" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-5 col-xs-12">
                                <p>Fornavn*:</p>
                            </div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="text" class="form-control" id="fb_first_name" name="fb_first_name"
                                value="<?php echo $fbUserProfile['first_name'] ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-5 col-xs-12">
                                <p>Efternavn*:</p>
                            </div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="text" class="form-control" id="fb_last_name" name="fb_last_name"
                                value="<?php echo $fbUserProfile['last_name'] ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-5 col-xs-12">
                                <p>E-mail*:</p>
                            </div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="email" class="form-control" id="fb_email" name="fb_email"
                                    value="<?php echo $fbUserProfile['email'] ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-6 col-xs-12">
                                <button id="merge_profile" class="btn btn-info btn-block">Yes</button>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                            <input type="hidden" name="action" id="action" value="NOT_MERGE">
                                <button type="submit" class="btn btn-danger btn-block">No</button>
                            </div>
                        </div>
                      </form>
                    <form action="#" method="post" name="ivn-fb" enctype="multipart/form-data">     
                    <div class="clearfix"></div>
                    </div><!--/Signup-->
                     <div class="sign-up-form m-t-20" id="verify_profile" style="display: none">
                        <div class="row m-t-20">
                            <div class="col-lg-5">
                                <p>E-mail*:</p>
                            </div>
                            <div class="col-lg-7">
                              <input type="hidden" class="form-control" id="fb_email" name="fb_email"
                                    value="<?php echo $fbUserProfile['email'] ?>">
                              <input type="text" class="form-control" name="login_email" id="login_email">
                                
                            </div>
                        </div>
                        <div class="row m-t-20">
                        <input type="hidden" name="action" id="action" value="VERIFY_IVN">
                            <div class="col-lg-5">
                                <p>Adgangskode*:</p>
                            </div>
                            <div class="col-lg-7">
                                <input type="password" class="form-control" name="login_password" id="login_password">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-9">
                            <p><small>
                                <a href="#" data-toggle="modal" data-target="#forget-password">Glemt din adgangskode?</a></small>
                             </p>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit"  class="btn btn-primary col-lg-12 verfiy_ivn">
                                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Login
                                </button>
                            </div>
                     </div>
                           
                    <div class="clearfix"></div>
                </div><!--/Signup-->
                </form>
        </div><!--access wrapper-->
        <!-- Modal -->

      </div> <!--/Signup--> 
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section-->
<script>
$("#merge_profile").on('click', function(e) {
    $('#verify_profile').slideToggle();
    e.preventDefault();
});
</script>
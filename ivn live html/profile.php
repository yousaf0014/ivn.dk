<?php include('header.php') ?>
<!--Access Section-->
<section class="profile-bg">
    <div class="container">    
      <div class="row m-t-65">
        <!--Signup-->
        <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2  m-t-65">
                <?php 	$profile_data =  get_row('users','where id = '. $_SESSION['user_id']);
							$data = mysql_fetch_assoc($profile_data);
							//user information
								$first_name 	= $data['firstname'];
								$last_name		= $data['lastname'];
								$email			= $data['email'];
								$address_one 	= $data['address'];
								$house_no 		= $data['housenumber'];
								$address_two 	= $data['address2'];
								$zip_code 		= $data['zipcode'];
								$phone 			= $data['mobile_phone'];
								$country 		= $data['country'];
								$city			= $data['city'];
								$birthday  		= $data['date_of_birth'];
								$gender_id  	= $data['gender_id'];
								$title  		= $data['job_title'];
								$primary_ocup  	= $data['userjobstatus_id'];
								$entrep_status  = $data['entrepreneurial_status_id'];
								$profile_image	= $data['profile_image'];
                                $primary_email  = $data['fb_email'];
								
								/* Get Day, Month, Year */
								if(($birthday=='0000-00-00') || (empty($birthday))){
									$year	= '0000';
									$month 	= '00';
									$day 	= '00';
								}else{
									$date  = strtotime($birthday);
									$year  = date('Y', $date);
									$month = date('m', $date);
									$day   = date('d', $date);
								}
								
								
								
					?>
                    
                
                <div class="access-wrapper trans-black-bg">
                    <h3>Profilbillede:</h3>
                    <div class="sign-up-form">
                    
                    <form action="#" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="profile_view">
                	
                    	<div class="row">
                    		<div class="col-lg-4 col-xs-10 col-xs-offset-1 col-lg-offset-4">
                            	<?php if(empty($profile_image)): ?>
                               		 <div id="avatar" style="background:url(assets/images/avatar_place_holder.png)"></div>
                                <?php else: ?>
                                	 <div id="avatar" style="background:url(<?php echo $profile_image ?>)"></div>
                                
								<?php endif;?>
                                <input class="avatar_image" id="avatar_image" type="file" accept="image/*" 
                               		 onChange="preview_avatar(event)" name="avatar_image"/>
                            </div>
                            <div class="clearfix"></div>
                      	 </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>Fornavn*:</p>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <input type="text" class="form-control" name="u_first_name" id="u_first_name" 
                                value="<?php echo $first_name ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>Efternavn*:</p>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <input type="text" class="form-control" name="u_last_name" id="u_last_name"
                                value="<?php echo $last_name ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>E-mail*:</p>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <input type="email" class="form-control" name="u_email" id="u_email"
                               	value="<?php echo $email ?>" readonly>
                                <small class="pull-left form-feedback" id="primary"
                                style="display:<?php  if(!empty($primary_email)){echo 'none';}else{
                            echo 'block';
                            } ?>">
                                <a href="javascript:(void)">Tilf&oslash;j en ekstra E-mail</a></small>
                            </div>
                        </div>
                        <div class="row m-t-20 primary_email" style="display: <?php  if(!empty($primary_email)){echo 'block';}else{
                            echo 'none';
                            } ?>" >
                            <div class="col-lg-4 col-xs-12">
                                <p>2. E-mail:</p>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <input type="email" class="form-control" name="p_email" id="p_email"
                                value="<?php echo $primary_email; ?>">
                                
                            </div>
                        </div>
                       
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Ny adgangskode*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="pull-right form-feedback" id="result">Minimum otte tegn.</small>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Bekr&aelig;ft adgangskode*:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                <small class="pull-right form-feedback" id="confirm_result">Minimum otte tegn.</small>
                            </div>
                        </div>
                        
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>Adresse 1:</p>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <input type="text" class="form-control" name="u_add_one" id="u_add_one" 
                                value="<?php echo $address_one ?>">
                            </div>
                            <div class="col-lg-2 col-xs-12  xs-t-20">
                            	<p>Husnummer:</p>
                            </div>
                            <div class="col-lg-2 col-xs-12">
                              <input type="number" class="form-control numeric" name="u_house_no" id="u_house_no"
                               value="<?php if(!empty($house_no)|| $house_no!=0) echo $house_no ?>" min="0">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Adresse 2:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="u_add_two" id="u_add_two" 
                                value="<?php echo $address_two ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>Postnummer:</p>
                            </div>
                            <div class="col-lg-2 col-xs-5">
                                 <input type="number" class="form-control numeric" name="u_post_code" id="u_post_code"
                                	value="<?php if($zip_code!=0) echo $zip_code ?>"  maxlength="4" min="0">
                            </div>
                             <div class="col-lg-1 col-xs-2">
                            	<p>By:</p>
                            </div>
                            <div class="col-lg-5 col-xs-5">
                                <input type="text" class="form-control" name="u_city" id="u_city"
                                value="<?php echo $city ?>">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Telefon:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="number" class="form-control numeric" name="u_phone" id="u_phone"
                                value="<?php echo $phone ?>" maxlength="8" min="0">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Land:</p>
                            </div>
                          	<?php __hook_country($country) ?>
                        </div>
                        
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>F&oslash;dselsdag:</p>
                            </div>
                            <?php __hock_date_of_birth__($year , $month , $day);?>
                        </div>
                        
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>K&oslash;n:</p>
                            </div>
                           		<?php hock_gender($gender_id) ?>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Titel:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="u_title" id="u_title"
                                value="<?php echo $title ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Prim&aelig;r besk&aelig;ftigelse:</p>
                            </div>
                            <?php hock_primary_occupation($primary_ocup); ?>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Tilknytning:</p>
                            </div>
                            <?php __entrepreneurial_status__($entrep_status) ?>
                        </div>
                        
                        <div class="row m-t-20">
                       		 <?php 
									//Get Company information
									$sql = get_row('company','where users_id = '. $_SESSION['user_id']);
									$company_data = mysql_fetch_assoc($sql);
									$company_name 			= $company_data['name'];
									$compnay_type  			= $company_data['company_type_id'];
									$comapny_cvr  			= $company_data['cvr'];
									$company_address_one 	= $company_data['address'];
									$company_house_no		= $company_data['housenumber'];
									$company_address_two 	= $company_data['address2'];
									$company_postal 		= $company_data['zipcode'];
									$company_phone 			= $company_data['mobile_phone'];
									$company_country 		= $company_data['country'];
									$company_city			= $company_data['city'];
									$company_web 			= $company_data['logo_url'];
									$company_email			= $company_data['email'];
									$company_no_of_emp 		= $company_data['employees'];
									$company_no_of_hours 	= $company_data['hours_pr_week'];
									$company_type_id		= $company_data['company_type_id'];
									
									
							?>
                        	<div class="col-lg-12">
                            	<h3>Min virksomhed</h3>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Firmanavn:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="u_business_name" id="u_business_name"
                                value="<?php echo $company_name ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                        	<div class="col-lg-4">
                                <p>Selskabsform:</p>
                            </div>
                            <?php __hook_company_type('company_type',$company_type_id) ?>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>CVR:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="number" class="form-control numeric" name="u_cvr_no" id="u_cvr_no" 
                                value="<?php if($comapny_cvr!=0) echo $comapny_cvr ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>Adresse 1:</p>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <input type="text" class="form-control" name="u_company_add_one" id="u_company_add_one"
                                value="<?php echo $company_address_one ?>">
                            </div>
                            <div class="col-lg-2 col-xs-12 xs-t-20">
                            	<p>Husnummer:</p>
                            </div>
                            <div class="col-lg-2 col-xs-12">
                                 <input type="number" class="form-control numeric" 
                                 name="u_company_house_no" id="u_company_house_no"
                                 value="<?php if($company_house_no!=0 || !empty($company_house_no)) echo $company_house_no ?>"
                                 min="0">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Adresse 2:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="u_company_add_two" id="u_company_add_two"
                                value="<?php echo $company_address_two ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-xs-12">
                                <p>Postnummer:</p>
                            </div>
                            <div class="col-lg-2 col-xs-5">
                                 <input type="number" class="form-control numeric" 
                                 	name="u_company_post_code" id="u_company_post_code"
                                 value="<?php if($company_postal!=0) echo $company_postal; ?>" maxlength="4" min="0">
                            </div>
                             <div class="col-lg-1 col-xs-2">
                            	<p>By:</p>
                            </div>
                            <div class="col-lg-5 col-xs-5">
                                <input type="text" class="form-control" name="u_company_city" id="u_company_city"
                                value="<?php echo $company_city ?>">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Telefon:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="number" class="form-control numeric" name="u_comapny_tell" id="u_comapny_tell"
                                value="<?php echo $company_phone ?>" maxlength="8" min="0">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Land:</p>
                            </div>
                               <?php  __hook_company_country($company_country) ?>
                            
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>WWW:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="u_comapny_website" id="u_comapny_website"
                                value="<?php echo $company_web ?>">
                                <input type="hidden" id="action" name="action" value="PROFILE_UPDATE"/>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Email:</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="u_comapny_email" id="u_comapny_email"
                                value="<?php echo $company_email ?>" >
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Antal ansatte:</p>
                            </div>
                            <?php __hook_num_of_employes($company_no_of_emp) ?>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-lg-4">
                                <p>Ugentligt timetal:</p>
                            </div>
                            <div class="col-lg-8">
                            	<?php __hooke_weekly_hours($company_no_of_hours) ?>
                            </div>
                        </div>
                        <div class="row m-t-20">
                        		</br>
                             <div class="col-lg-4 col-lg-offset-4 col-xs-12 xs-t-20">
                             <input type="submit" class="btn btn-primary col-lg-12 col-xs-12" 
                                value="Gem &aelig;ndringer"/>
                            </div>
                            
                            <div class="col-lg-4 col-lg-offset-4 col-xs-12 m-t-20 text-center">
                            	<p>
                                <a href="#" data-toggle="modal" data-toggle="modal" 
                                data-target="#terms-conditions">Brugerbetingelserne</a></p>
                        		</div>
                         </div>
                    </form>
                     <div class="row">
                            <div class="col-lg-4 col-lg-offset-4 col-xs-12 text-center">
                            <p>
                             	<?php /*?><a href="#" onClick="return perform_delete_action(this)" 
                             	data-id="<?php echo $_SESSION['user_toekn'] ?>">Slet min profil</a>
                                <?php */?>
                                <a href="#" data-record-id="<?php echo $_SESSION['user_toekn'] ?>" 
                                data-toggle="modal" data-target="#confirm-delete">Slet min profil</a>
                                
                            </p>
                            </div>
                     </div>   
                    <div class="clearfix"></div>
                </div><!--/Signup-->
        </div><!--access wrapper-->
       
        <!-- Modal -->

      </div> <!--/Signup--> 
        
      </div><!--/row-->
    </div><!--Container-->
</section><!--/Access Section-->


<!--Terms and Condition Popup-->
	<?php require_once('libs/terms-and-conditons.php') ?>
<!--/Terms and Condition-->


<!--Terms and Condition Popup-->
	<?php require_once('libs/confirm-delete.php') ?>
<!--/Terms and Condition-->

<?php include('footer.php') ?>
<!--Page Script-->
<script src="assets/plugin/areyousure/jquery.are-you-sure.min.js"></script>
<script src="assets/plugin/numeric/jquery-numeric.js"></script>
<script type="text/javascript">
    $(function() {
		$("input.numeric").numeric();
        // Example 3 - custom message and hooking the dirty change events
        $('#profile_view').areYouSure({
            message: "Har du glemt at gemme din profil?"
        });
        $("#primary").on("click",function(){
              $('.primary_email').slideToggle(100);
        });
    });
</script>
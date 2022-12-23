<?php require_once('configuration.php'); ?>
<?php require_once('function.php'); ?>
<?php 
	$action		= mysql_real_escape_string($_POST['action']);
		switch($action){
			case 'SIGNUP':
			$first_name 		= mysql_real_escape_string($_POST['first_name']);
			$last_name 			= mysql_real_escape_string($_POST['last_name']);
			$email				= mysql_real_escape_string($_POST['email']);
			$password			= mysql_real_escape_string($_POST['password']);
			$confirm_password  	= mysql_real_escape_string($_POST['confirm_password']);
				
				if(empty($first_name) || empty($last_name) || empty($email)){
							die(ALL_FIELDS_REQUIRED);
				}
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						die(NOT_VALID_EMAIL);
					}
				//Check if email is not already exists
				if(!Dubplicate('users','email',$email)){
					//Check Password Strngth
					if(strlen($password) < 8){
						die(PASSWORD_TOO_SHORT);
					}else if($password!=$confirm_password){
							die(PASSWORD_NOT_MATCH);
				}else{
						
							//Get Salt
							$salt = generateSalt();
							$password = generateHashWithSalt($password,$salt);
							//generating user token
							$user_token = generateHashWithSalt($email,$salt);
							
							$form_data = array(
								'firstname' => $first_name,
								'lastname' => $last_name,
								'gender_id' => 3,
								'email' => $email,
								'userjobstatus_id' => 4,
								'entrepreneurial_status_id' => 4,
								'user_type_id' => 3,
								'verified' => 0,
								'password_hash' => $password,
								'password_salt' => $salt,
								'active' => 1,
								'user_token'=>$user_token,
								'created' => date('Y-m-d H:i:s')
							);
							if(Insert_Single_Row('users',$form_data)){
								echo INSERT_SUCCESSFULLY.'</br>';
								generate_verification_email(mysql_insert_id());
							}else{
								echo INSERT_ERROR;
							}
						}
					}else{
						echo DUPLICATE_EMAIL;
					}
			break;	
			
			case 'PROFILE_UPDATE':
					$UPDATE_PASSWORD_FLAG = FALSE;
					$user_id			= mysql_real_escape_string($_POST['user_id']);
					
					//Passwords Block
					$new_password   			= mysql_real_escape_string($_POST['password']);
					$confirm_new_password   	= mysql_real_escape_string($_POST['confirm_password']);
						if(isset($new_password) && !empty($new_password)){
								
								$row      = get_row('users',"where id = $user_id");
								$result   = mysql_fetch_assoc($row);
								$name	  = $result['firstname'].' '.$result['lastname'];
								$salt     =  $result['password_salt'];
								$password =  $result['password_hash'];
									if($new_password == $confirm_new_password){
												if(strlen($new_password) < 8){
													die(PASSWORD_TOO_SHORT);
												}else{
													$salt 			 = generateSalt();
													$update_password = generateHashWithSalt($new_password,$salt);
													$UPDATE_PASSWORD_FLAG = TRUE;
												}
										}else{
											die(PASSWORD_NOT_MATCH);
										}
									
							}
					
					/* Image Handling */
						$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
						$path = '../profile_avatar/';
						
					// Getting All Data 
					$p_first_name  	= mysql_real_escape_string ($_POST['u_first_name']);
					$p_last_name   	= mysql_real_escape_string ($_POST['u_last_name']);
					$p_email		 	= mysql_real_escape_string ($_POST['u_email']);
					$p_password		= mysql_real_escape_string ($_POST['password']);
					$p_confirm_pass 	= mysql_real_escape_string ($_POST['confirm_password']);
					$p_address_one		= mysql_real_escape_string ($_POST['u_add_one']);
					$p_house_no		= mysql_real_escape_string ($_POST['u_house_no']);
					$p_address_two		= mysql_real_escape_string ($_POST['u_add_two']);
					$p_postal_code		= mysql_real_escape_string ($_POST['u_post_code']);
					$p_city				= mysql_real_escape_string ($_POST['u_city']);
					$p_phone			= mysql_real_escape_string ($_POST['u_phone']);
					$p_country			= mysql_real_escape_string ($_POST['u_country']);
					
					/*Birthday */
					$p_bdy_day			= mysql_real_escape_string ($_POST['u_bdy_day']);
					$p_bdy_month		= mysql_real_escape_string ($_POST['u_bdy_month']);
					$p_bdy_year			= mysql_real_escape_string ($_POST['u_bdy_year']);
					$date = new DateTime();
					$date->setDate($p_bdy_year, $p_bdy_month, $p_bdy_day);
					$final_date =  $date->format('Y-m-d');
						//if date is not selected
						if($p_bdy_day=='day' || $p_bdy_month=='month' || $p_bdy_year=='year'){
							$final_date= null;
						}
					/* Birthday End*/
					
					$p_gender			= mysql_real_escape_string ($_POST['gender']);
						//If gender is not selected
					if(empty($p_gender)){ $p_gender=3; } 	
					
					$p_job_title		= mysql_real_escape_string ($_POST['u_title']);
					$p_job_status		= mysql_real_escape_string ($_POST['u_primary_occu']);
					$p_entrep_status    = mysql_real_escape_string ($_POST['u_ent_status']);
					
					$user_type = 1;
					
					/* User Company */
					$c_busniess_name    = mysql_real_escape_string ($_POST['u_business_name']);
					$c_company_type		= mysql_real_escape_string( $_POST['u_comp_type']);
					$c_cvr_no			= mysql_real_escape_string ($_POST['u_cvr_no']);
					$c_address_one		= mysql_real_escape_string ($_POST['u_company_add_one']);
					$c_address_two		= mysql_real_escape_string ($_POST['u_company_add_two']);
					$c_house_no			= mysql_real_escape_string ($_POST['u_company_house_no']);
					$c_postal			= mysql_real_escape_string ($_POST['u_company_post_code']);
					$c_city				= mysql_real_escape_string ($_POST['u_company_city']);
					$c_tel				= mysql_real_escape_string ($_POST['u_comapny_tell']);
					$c_country			= mysql_real_escape_string ($_POST['u_comapny_country']);
					$c_business_web		= mysql_real_escape_string ($_POST['u_comapny_website']);
					$c_email			= mysql_real_escape_string($_POST['u_comapny_email']);
					$c_num_of_emp		= mysql_real_escape_string ($_POST['u_comapny_no_of_emp']);
					$c_no_of_hous_week	= mysql_real_escape_string ($_POST['no_of_hours_week']);
						
							if(strlen($p_postal_code)>4 || strlen($c_postal)>4){
								die(POSTL_CODE_ERROR);
							}
							if(strlen($p_phone)>8 || strlen($c_tel)>8){
								die(TELEPHONE_ERROR);
							}
							if (filter_var($c_business_web, FILTER_VALIDATE_URL) === false && !empty($c_business_web)) {
								//die(INVALID_URL);
							}
							if (!filter_var($c_email, FILTER_VALIDATE_EMAIL) && !empty($c_email)) {
								die(NOT_VALID_EMAIL);
							}
					/* Build User Data */
					$user_data = array(
							'firstname' => $p_first_name,
							'lastname' => $p_last_name,
							'gender_id' => $p_gender,
							'email' => $p_email,
							'userjobstatus_id' => $p_job_status,
							'entrepreneurial_status_id' => $p_entrep_status,
							'user_type_id' => $user_type,
							'address'=>$p_address_one,
							'address2'=>$p_address_two,
							'housenumber'=>$p_house_no,
							'zipcode'=>$p_postal_code,
							'city'=>$p_city,
							'country'=>$p_country,
							'mobile_phone'=>$p_phone,
							'date_of_birth'=>$final_date,
							'job_title'=>$p_job_title,
							'updated' => date('Y-m-d H:i:s'),
						);
						if(isset($_FILES['avatar_image'])){
								$img = $_FILES['avatar_image']['name'];
								$img = str_replace(' ', '_', $img);
								$tmp = $_FILES['avatar_image']['tmp_name'];
								
								// get uploaded file's extension
								$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
								
								// can upload same image using rand function
								$final_image = rand(1000,1000000).$img;
								
								// check's valid format
								if(in_array($ext, $valid_extensions)) 
								{					
									$path = $path.strtolower($final_image);	
										
									if(move_uploaded_file($tmp,$path)) 
									{ 
										$path = 'profile_avatar/';
										$path = $path.strtolower($final_image);	
										$user_data['profile_image']  = $path;
									}
								} 
						}
							if($UPDATE_PASSWORD_FLAG){
								$user_data['password_hash'] = $update_password;
								$user_data['password_salt']   = $salt;
							}
						if(!dbRowUpdate("users",$user_data,"id = $user_id")){
								die(INSERT_ERROR);
						}
							
							//Company Data
							$company_data = array(
										'users_id'			=> $user_id,
										'name' 				=> $c_busniess_name,
										'company_type_id' 	=> $c_company_type,
										'cvr'				=> $c_cvr_no,
										'address' 			=> $c_address_one,
										'housenumber' 		=> $c_house_no,
										'address2' 		=> $c_address_two,
										'zipcode' 			=> $c_postal,
										'city' 				=> $c_city,
										'mobile_phone'		=> $c_tel,
										'country'			=> $c_country,
										'logo_url'			=> $c_business_web,
										'email'				=> $c_email,
										'employees'		=> $c_num_of_emp,
										'hours_pr_week'	=> $c_no_of_hous_week,
										'active'=>1,
										'created' 			=> date('Y-m-d H:i:s'),
									);
							if(!empty($c_cvr_no)){
									if(strlen($c_cvr_no)<8){
										die('CVR Must be atleast 8 Character Long');
									}
							}
						//Check If user have company
						$company   = get_row('company',"where users_id = $user_id");
						if(mysql_num_rows($company) > 0){
								$company_prev_data  = mysql_fetch_assoc($company);
								$company_id			= $company_prev_data['id'];
								$company_data['id'] = $company_id;
								//Remove Created Date and Add Updated Date
								unset($company_data['key1']);
								//Add Updated Information
								$company_data['updated']  = date('Y-m-d H:i:s');
								
								if(dbRowUpdate("company",$company_data,"id = $company_id")){
									echo RECORD_UPDATED;
								}else{
									die(COMPANY_UPDATING_ERROR);
								}
						}else{
								/* Creat Company */	
								if(Insert_Single_Row("company",$company_data)){
									echo RECORD_UPDATED;
								}else{
									die(COMPANY_UPDATING_ERROR);
								}
						}
						
			break;
			case 'FORGET_PASSWORD':
					$forget_password_email = mysql_real_escape_string($_POST['forget_password_email']);
						if(empty($forget_password_email)){
							die(ALL_FIELDS_REQUIRED);
						}else{
							start_forget_password($forget_password_email);
						}
			break;
			case 'Update_PASS':
					$new_reset_pass = mysql_real_escape_string($_POST['password']);
					$confirm_reset_pass = mysql_real_escape_string($_POST['confirm_password']);
					$verfication_reset_key = mysql_real_escape_string($_POST['v_pass']);
						
						
					if(strlen($new_reset_pass) < 8){
						die(PASSWORD_TOO_SHORT);
						
					}else if($new_reset_pass!=$confirm_reset_pass){
							die(PASSWORD_NOT_MATCH);
							
					}
				$check_token   = get_row("users", " where  `verification_token` = '".$verfication_reset_key."'");
				if(mysql_num_rows($check_token) > 0){
					$salt = generateSalt();
					$new_reseted_password = generateHashWithSalt($new_reset_pass,$salt);
					$forget_data = array(
								'password_hash' => $new_reseted_password,
								'password_salt' => $salt,
								'verification_token'=>null,
								'updated' => date('Y-m-d H:i:s')
								);
								
					if(dbRowUpdate("users",$forget_data,"`verification_token` = '$verfication_reset_key'")){
								echo PASSWORD_UPDATE;
								echo ("<SCRIPT LANGUAGE='JavaScript'>
												  window.location.href='active.php';
									</SCRIPT>");
						}else{
							die(PASSWORD_UPDATE_ERROR);
								
							
						}
				}else{
					die(PASSWORD_UPDATE_ERROR);
				}
			break;
			case 'DELETE_USER':
				$delete_id = mysql_real_escape_string($_POST['id']);
					//getting user id based on user token
					$user_result = get_row("users","where user_token = '$delete_id'");
					$result   = mysql_fetch_assoc($user_result);
					$user_id = $result['id'];
					echo ERASING_COMPANY_DATA.'</br>';
					if(dbRowDelete('company','where users_id ='.$user_id)){
						echo ERASING_USER_DATA;
						if(dbRowDelete('users','where id ='.$user_id)){
							echo ("<SCRIPT LANGUAGE='JavaScript'>
									 window.location.href='libs/logout.php';
									</SCRIPT>");
						}else{
							die (ERASING_PROBLEM);
						}
						
					}else{
						die (ERASING_PROBLEM);
					}
					
				
				break;
			case 'CONTACT-US':
					$contact_name  = mysql_real_escape_string($_POST['contact_name']);
					$contact_email = mysql_real_escape_string($_POST['contact_email']);
					$contact_msg   = mysql_real_escape_string($_POST['contact_msg']);
						if(empty($contact_name) || empty($contact_email) || empty($contact_name)){
							die(ALL_FIELDS_REQUIRED);
						}
						if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
								die(NOT_VALID_EMAIL);
						}
						generate_contact_us_email($contact_name , $contact_email, $contact_msg);
			break;
			case 'SUBSCRIBE':
					//geting variables
					$sub_name    = mysql_real_escape_string($_POST['sub_name']);
					$sub_email   = mysql_real_escape_string($_POST['sub_email']);
					$sub_company = mysql_real_escape_string($_POST['sub_company']);
					if(empty($sub_name) || (empty($sub_company))){
						die(ALL_FIELDS_REQUIRED);
						
					}if (!filter_var($sub_email, FILTER_VALIDATE_EMAIL) && !empty($c_email)) {
							die(NOT_VALID_EMAIL);
					}
						
						generat_subscribtion_email($sub_name,$sub_email,$sub_company);
					
				break;
		default:
			echo SOMETHING_WENT_WRONG;
			break;
		}

?>
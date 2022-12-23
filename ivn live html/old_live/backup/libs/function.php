<?php 
define("MAX_LENGTH", 10);
define("INSERT_SUCCESSFULLY", "Brugeren er oprettet.");
define("INSERT_ERROR", "Der opstod en fejl under oprettelsen.");
define("DUPLICATE_EMAIL","Denne e-mail findes allerede.");
define("ALL_FIELDS_REQUIRED","Alle felter skal udfyldes.");
define('INVALID_EMAIL', "Denne e-mail findes ikke.");
define('INVALID_PASSWORD', "Forkert adgangskode.");
define('RECORD_UPDATED' ,"Profilen er opdateret.");
define("SOMETHING_WENT_WRONG","Noget gik galt. Udfyld felterne igen.");
define("USER_IS_NOT_VERIFIED","Bekræft venligst din e-mail for at logge ind.");
define("CHECK_EMAIL_TO_VERIFY","Tjek din mailbox for at bekræfte din e-mail.");
define("EMAIL_ERROR","Der skete en fejl, da vi sendte din e-mail.");
define("CHECK_EMAIL_TO_RESET_PASS","Tjek venligst din e-mail for at ændre din adgangskode.");
define("PASSWORD_UPDATE_ERROR","Der skete en fejl, da vi ville opdatere dit adgangskode.");
define("PASSWORD_UPDATE","Adgangskoden er opdateret.");
define("PASSWORD_TOO_SHORT","Adgangkoden skal være minimum 8 tegn.");
define("PASSWORD_NOT_MATCH","Adgangskoderne er ikke ens.");
define("OLD_PASSWORD_IS_WRONG","Tjek venligst, at den gamle adgangskode er korrekt.");
define("COMPANY_UPDATING_ERROR","Der skete en fejl, da vi opdaterede dine informationer.");
define("NOT_VALID_EMAIL", "Ugyldig e-mail");
define("INVALID_URL","Adressen er ikke gyldig");
define("POSTL_CODE_ERROR","Postnr. skal indeholde fire cifre");
define("TELEPHONE_ERROR","Telefonnummer skal indeholde otte cifre.");
define("CONTACT_YOU_SHORTLY","Tak for din email. Vi vil kontakte dig snarest.");
define("ERASING_COMPANY_DATA","Sletter Virksomhedsinfo");
define("ERASING_USER_DATA","Sletter Brugerprofil");
define("ERASING_PROBLEM","Der opstod et problem, mens vi slettede din profil");

define("FACEBOOK_MERGE","Facebook Merged with IVN");
define("MERGE_ERROR","Error While Merging");

date_default_timezone_set('Asia/Beirut');


function Insert_Single_Row($table_name, $form_data)
{
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);

    // build the query
    $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";

    // run and return the query result resource
    return mysql_query($sql)or die(mysql_error());
}
function dbRowDelete($table_name, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
    // run and return the query result resource
    return mysql_query($sql)or die(ERASING_PROBLEM);
}
function Dubplicate($table , $field , $equal_to){
	$sql = "select ".$field." from ".$table." where ".$field." = '$equal_to'";

	$result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result) > 0):
			return true;
		else:
			return false;
		endif;
	
}
// function primary_check($table , $field , $primary,$user_email){
// 	$sql = "select ".$field." from ".$table." where ".$field." = '$user_email' and fb_email = '$primary'";

// 	$result = mysql_query($sql) or die(mysql_error());
// 	if(mysql_num_rows($result) > 0):
// 			return true;
// 		else:
// 			return false;
// 		endif;
	
// }
function generateHashWithSalt($password,$salt) {
	return hash("sha256", $password . $salt);
}
function generateSalt(){
		$intermediateSalt = md5(uniqid(rand(), true));
		$salt = substr($intermediateSalt, 0, MAX_LENGTH);
		return $salt;
}
function login_authenticate($email){
	$sql 	= "select * from users where email ='$email' or fb_email = '$email'";
	$data   = mysql_query($sql)or die(mysql_error());
	if(mysql_num_rows($data) > 0):
		return true;
	else:
		return false;
	endif;
}	
function get_month($monthNum){
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
return $monthName = $dateObj->format('F'); // March
}
function get_row($table,$where){
	$sql = "select * from ".$table.' '.$where;
	return mysql_query($sql);
}
function validate_password($salt,$login_password,$password){
	if($password===hash("sha256", $login_password.$salt)){
	 	return true;
	 }else{
	 	return false;
	 }
}
function generate_contact_us_email($name , $email, $msg){
	
		
	//Generating Code	
	$message="<h3>Name: $name</h3>";
	$message.="<h3>Email: $email</h3>";
	$message.="<p style='line-height: 21px;'>Besked: $msg </p>";
	//replacing all newline with html entity
	$message = str_replace('\r\n','<br>',$message);
	$message = str_replace('\n','<br>',$message);
	$message = str_replace('\r','<br>',$message);
	
           
        SendEmail('info@ivn.dk', 'IVN | Besked', $message,CONTACT_YOU_SHORTLY);
          
          
}
function start_forget_password($email){
  
    
   
 
    
		$user_data_for_pass =  get_row('users',"where email = '$email'");
		$user_pass_data	 	=  mysql_fetch_assoc($user_data_for_pass);
		$email  	     	=  $user_pass_data['email'];
		$pass_id			= $user_pass_data['id'];
		
	//Generating Code	
	$salt = generateSalt();
	$verification_code = md5($email.$salt);
	$verification_data = array('verification_token' => $verification_code);
	//Storing Verification Code
	dbRowUpdate('users',$verification_data, "where id = $pass_id");
	//Generating Message
	$message='<h3>Glemt adgangskode?</h3></br><p>Det sker. Vi har sendt dig et link, 
					som du kan bruge til at indtaste en ny adgangskode.</p>';
	$message.='<a href="http://ivn.dk/reset.php?p='.$verification_code.'">Klik her</a>';
	$message.='<p>God fornøjelse.</p>';
   
        SendEmail($email, 'IVN | Opret nyt password', $message,CHECK_EMAIL_TO_RESET_PASS);
      		
}

function generate_verification_email($user_id){
    
	$user_data_for_email = get_row('users',"where id = $user_id");
	$user_result_data	 =	mysql_fetch_assoc($user_data_for_email);
	$email  			 = $user_result_data['email'];
	$pass_id			= $user_pass_data['id'];
		
	//Generating Code	
	$salt = generateSalt();
	$verification_code = md5($email.$salt);
	$verification_data = array('verification_token' => $verification_code);
	//Storing Verification Code
	dbRowUpdate('users',$verification_data, "where id = $user_id");
	//Generating Message
	$message= '<h3>Velkommen til IVN.dk</h3></br><p>Du har fornyligt oprettet en profil på siden, og vi glæder os til at vise dig, hvad vi kan tilbyde.</p>';
	$message.='<a href="http://ivn.dk/v/verify-email.php?q='.$verification_code.'">Klik her for at færdiggøre oprettelsen.</a>';
	$message.='<p>Vi ses på IVN.dk.</p>';

        SendEmail($email, 'Velkommen til IVN - Godkend E-mail', $message,CHECK_EMAIL_TO_VERIFY);

      
}
function generat_subscribtion_email($name_sub , $email_sub , $company_sub){
	$email   = 'info@whyorange.dk';
	$message = '<p>First Name:'.$name_sub.'<br>Email: '.$email_sub.'<br>Company Name: '.$company_sub.'</p>';
	
     SendEmail($email, 'Tilmelding til nyhedsbrev', $message,"Tak for din tilmelding.");

}
function generat_jura_email($name_sub , $email_sub , $company_sub){
	$email   = 'lasse@whyorange.dk';

	$message = '<p>First Name:'.$name_sub.'<br>Email: '.$email_sub.'<br>Company Name: '.$company_sub.'</p>';
	
     SendEmail($email, 'Tilmelding til nyhedsbrev', $message,"Tak for din tilmelding.");

}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}



function SendEmail($email,$subject,$body,$okmessage){
    
    $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>'.$body.'</body>
</html>';
    
    
    $messageid = '<'.getGUID(). '@'.'smtp.web10.net'.'>';
     
    
 require_once "Mail.php";

 $host = "mail.web10.net";
 $port = 587;
 $username = 'no-reply@ivn.dk';
 $password = 'WhyOrange4';

 $headers = array ('From' => $username, 'To' => $email, 'Subject' => $subject, 'Date' => date('r', time()),"Content-Type" => "multipart/alternative; charset=UTF-8","MIME-Version" => "1.0","Message-ID" => $messageid);
 $smtp = Mail::factory('smtp',
 array (
 'host' => $host,
 'port'=>$port,
 'auth' => true,
 'username' => $username,
 'password' => $password,
 'localhost' => 'mail.web10.net'));

 $mail = $smtp->send($email, $headers, $html);

 if (PEAR::isError($mail)) {
    die(EMAIL_ERROR);
 } else {
      die($okmessage);
 }

}
 











// again where clause is left optional
function dbRowUpdate($table_name, $form_data, $where_clause='')
{
	
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
	}
    $sql .= implode(', ', $sets);
	
    // append the where statement
    $sql .= $whereSQL;
	
	// run and return the query result
    return mysql_query($sql)or die('Error While Updating');
}
function hock_gender($gender_id){
	if($gender_id==1){
        echo '<div class="col-lg-3 col-xs-6">
		<div class="radio radio-primary">
            <p><input type="radio" name="gender" id="genderm" value="1" checked><label for="genderm">&nbsp;&nbsp;Mand</p></div>
        </div>';
        echo '<div class="col-lg-3 col-xs-6"><div class="radio radio-primary">
            <p><input type="radio" name="gender" id="genderf" value="2" ><label for="genderf">&nbsp;Kvinde</label></p></div>
        </div>';
    }if($gender_id==2){
       echo '<div class="col-lg-3 col-xs-6">
		<div class="radio radio-primary">
            <p><input type="radio" name="gender" id="genderm" value="1" ><label for="genderm">&nbsp;&nbsp;Mand</p></div>
        </div>';
        echo '<div class="col-lg-3 col-xs-6"><div class="radio radio-primary">
            <p><input type="radio" name="gender" id="genderf" value="2" checked><label for="genderf">&nbsp;Kvinde</label></p></div>
        </div>';
    }else if($gender_id!=1 && $gender_id!=2){
      echo '<div class="col-lg-3 col-xs-6">
		<div class="radio radio-primary">
            <p><input type="radio" name="gender" id="genderm" value="1" ><label for="genderm">&nbsp;&nbsp;Mand</p></div>
        </div>';
        echo '<div class="col-lg-3 col-xs-6"><div class="radio radio-primary">
            <p><input type="radio" name="gender" id="genderf" value="2"><label for="genderf">&nbsp;&nbsp;Kvinde</label></p></div>
        </div>';
    }
}
function hock_primary_occupation($occupation_id){
	echo '<div class="col-lg-8">
           <select  class="form-control" name="u_primary_occu" id="u_primary_occu">';
	$id = get_row('userjobstatus', "where id = $occupation_id");
		if(mysql_num_rows($id)>0){
				$data = mysql_fetch_assoc($id);
				$id   = $data['id'];
				$status_name = mysql_real_escape_string($data['name']);
				echo "<option value='$id' selected>$status_name</option>";
				
		}
	echo '<option value="1">Selvstændig</option>
		  <option value="2">Studerende</option>
		  <option value="3">Lønmodtager</option>
	</select>
	</div>';
}
function __entrepreneurial_status__($entrepreneurial_id){
echo '<div class="col-lg-8">
		<select  class="form-control" id="u_ent_status" name="u_ent_status">';
		$id = get_row('entrepreneurial_status', "where id = $entrepreneurial_id");
		if(mysql_num_rows($id)>0){
				$data 		= mysql_fetch_assoc($id);
				$id   		= $data['id'];
				$ent_name 	= $data['name'];
				echo "<option value='$id' selected>$ent_name</option>";
				
		}
		
		echo'<option value="1">Jeg er iværksætter</option>
			<option value="2">Jeg bliver snart iværksætter</option>
			<option value="3">Jeg er interesseret i iværksætteri</option>
			
		</select>
	</div>';
}
function __hock_date_of_birth__($year , $month , $day){
/* Day */
echo'<div class="col-lg-2">
	<select class="form-control" name="u_bdy_day" id="u_bdy_day">';
	
		if($day!='00'){
			echo "<option value='$day' selected>$day</option>";
		}else{
			echo "<option value='day' selected>Dag</option>";
		}
echo   '<option value="01">01</option>
		<option value="02">02</option>
		<option value="03">03</option>
		<option value="04">04</option>
		<option value="05">05</option>
		<option value="06">06</option>
		<option value="07">07</option>
		<option value="08">08</option>
		<option value="09">09</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
	</select>
</div>';
/* Month */
echo '<div class="col-lg-3 xs-t-20">
	<select class="form-control" name="u_bdy_month" id="u_bdy_month">';
		if($month!='00'){
				echo "<option value='$month' selected>".get_month($month)."</option>";
		}else{
			echo "<option value='month' selected>Måned</option>";
		
		}
		echo'<option value="01">Januar</option>
			<option value="02">Februar</option>
			<option value="03">Marts</option>
			<option value="04">April</option>
			<option value="05">Maj</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">December</option>
	</select>
</div>';
/* Year */
echo '<div class="col-lg-3 xs-t-20">
	<select class="form-control" name="u_bdy_year" id="u_bdy_year">';
	if($year!='0000'){
				echo "<option value='$year' selected>$year</option>";
		}else{
			echo "<option value='year' selected>År</option>";
		
		}
	
		for($y = 1900 ; $y <=2016 ; $y++ ){
			echo "<option value='$y'>$y</option>";
		}
	echo' </select>
</div>';
}
function __hook_country($country){
	echo '<div class="col-lg-8">
<select class="form-control" name="u_country" id="u_country">';
if(!empty($country) && $country!='Vælg'):
	echo "<option value='$country' selected>$country</option>";
	else:
	$character ="Vælg";
	//$character = htmlspecialchars("Vælg", ENT_QUOTES);
		echo'<option value="Vælg" selected>'.$character.'</option>';
	endif;?>
	<option value="Afghanistan">Afghanistan</option>
	<option value="Albania">Albania</option>
	<option value="Algeria">Algeria</option>
	<option value="American Samoa">American Samoa</option>
	<option value="Andorra">Andorra</option>
	<option value="Angola">Angola</option>
	<option value="Anguilla">Anguilla</option>
	<option value="Antartica">Antarctica</option>
	<option value="Antigua and Barbuda">Antigua and Barbuda</option>
	<option value="Argentina">Argentina</option>
	<option value="Armenia">Armenia</option>
	<option value="Aruba">Aruba</option>
	<option value="Australia">Australia</option>
	<option value="Austria">Austria</option>
	<option value="Azerbaijan">Azerbaijan</option>
	<option value="Bahamas">Bahamas</option>
	<option value="Bahrain">Bahrain</option>
	<option value="Bangladesh">Bangladesh</option>
	<option value="Barbados">Barbados</option>
	<option value="Belarus">Belarus</option>
	<option value="Belgium">Belgium</option>
	<option value="Belize">Belize</option>
	<option value="Benin">Benin</option>
	<option value="Bermuda">Bermuda</option>
	<option value="Bhutan">Bhutan</option>
	<option value="Bolivia">Bolivia</option>
	<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
	<option value="Botswana">Botswana</option>
	<option value="Bouvet Island">Bouvet Island</option>
	<option value="Brazil">Brazil</option>
	<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
	<option value="Brunei Darussalam">Brunei Darussalam</option>
	<option value="Bulgaria">Bulgaria</option>
	<option value="Burkina Faso">Burkina Faso</option>
	<option value="Burundi">Burundi</option>
	<option value="Cambodia">Cambodia</option>
	<option value="Cameroon">Cameroon</option>
	<option value="Canada">Canada</option>
	<option value="Cape Verde">Cape Verde</option>
	<option value="Cayman Islands">Cayman Islands</option>
	<option value="Central African Republic">Central African Republic</option>
	<option value="Chad">Chad</option>
	<option value="Chile">Chile</option>
	<option value="China">China</option>
	<option value="Christmas Island">Christmas Island</option>
	<option value="Cocos Islands">Cocos (Keeling) Islands</option>
	<option value="Colombia">Colombia</option>
	<option value="Comoros">Comoros</option>
	<option value="Congo">Congo</option>
	<option value="Congo">Congo, the Democratic Republic of the</option>
	<option value="Cook Islands">Cook Islands</option>
	<option value="Costa Rica">Costa Rica</option>
	<option value="Cota D'Ivoire">Cote d'Ivoire</option>
	<option value="Croatia">Croatia (Hrvatska)</option>
	<option value="Cuba">Cuba</option>
	<option value="Cyprus">Cyprus</option>
	<option value="Czech Republic">Czech Republic</option>
	<option value="Denmark">Denmark</option>
	<option value="Djibouti">Djibouti</option>
	<option value="Dominica">Dominica</option>
	<option value="Dominican Republic">Dominican Republic</option>
	<option value="East Timor">East Timor</option>
	<option value="Ecuador">Ecuador</option>
	<option value="Egypt">Egypt</option>
	<option value="El Salvador">El Salvador</option>
	<option value="Equatorial Guinea">Equatorial Guinea</option>
	<option value="Eritrea">Eritrea</option>
	<option value="Estonia">Estonia</option>
	<option value="Ethiopia">Ethiopia</option>
	<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
	<option value="Faroe Islands">Faroe Islands</option>
	<option value="Fiji">Fiji</option>
	<option value="Finland">Finland</option>
	<option value="France">France</option>
	<option value="France Metropolitan">France, Metropolitan</option>
	<option value="French Guiana">French Guiana</option>
	<option value="French Polynesia">French Polynesia</option>
	<option value="French Southern Territories">French Southern Territories</option>
	<option value="Gabon">Gabon</option>
	<option value="Gambia">Gambia</option>
	<option value="Georgia">Georgia</option>
	<option value="Germany">Germany</option>
	<option value="Ghana">Ghana</option>
	<option value="Gibraltar">Gibraltar</option>
	<option value="Greece">Greece</option>
	<option value="Greenland">Greenland</option>
	<option value="Grenada">Grenada</option>
	<option value="Guadeloupe">Guadeloupe</option>
	<option value="Guam">Guam</option>
	<option value="Guatemala">Guatemala</option>
	<option value="Guinea">Guinea</option>
	<option value="Guinea-Bissau">Guinea-Bissau</option>
	<option value="Guyana">Guyana</option>
	<option value="Haiti">Haiti</option>
	<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
	<option value="Holy See">Holy See (Vatican City State)</option>
	<option value="Honduras">Honduras</option>
	<option value="Hong Kong">Hong Kong</option>
	<option value="Hungary">Hungary</option>
	<option value="Iceland">Iceland</option>
	<option value="India">India</option>
	<option value="Indonesia">Indonesia</option>
	<option value="Iran">Iran (Islamic Republic of)</option>
	<option value="Iraq">Iraq</option>
	<option value="Ireland">Ireland</option>
	<option value="Israel">Israel</option>
	<option value="Italy">Italy</option>
	<option value="Jamaica">Jamaica</option>
	<option value="Japan">Japan</option>
	<option value="Jordan">Jordan</option>
	<option value="Kazakhstan">Kazakhstan</option>
	<option value="Kenya">Kenya</option>
	<option value="Kiribati">Kiribati</option>
	<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
	<option value="Korea">Korea, Republic of</option>
	<option value="Kuwait">Kuwait</option>
	<option value="Kyrgyzstan">Kyrgyzstan</option>
	<option value="Lao">Lao People's Democratic Republic</option>
	<option value="Latvia">Latvia</option>
	<option value="Lebanon">Lebanon</option>
	<option value="Lesotho">Lesotho</option>
	<option value="Liberia">Liberia</option>
	<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
	<option value="Liechtenstein">Liechtenstein</option>
	<option value="Lithuania">Lithuania</option>
	<option value="Luxembourg">Luxembourg</option>
	<option value="Macau">Macau</option>
	<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
	<option value="Madagascar">Madagascar</option>
	<option value="Malawi">Malawi</option>
	<option value="Malaysia">Malaysia</option>
	<option value="Maldives">Maldives</option>
	<option value="Mali">Mali</option>
	<option value="Malta">Malta</option>
	<option value="Marshall Islands">Marshall Islands</option>
	<option value="Martinique">Martinique</option>
	<option value="Mauritania">Mauritania</option>
	<option value="Mauritius">Mauritius</option>
	<option value="Mayotte">Mayotte</option>
	<option value="Mexico">Mexico</option>
	<option value="Micronesia">Micronesia, Federated States of</option>
	<option value="Moldova">Moldova, Republic of</option>
	<option value="Monaco">Monaco</option>
	<option value="Mongolia">Mongolia</option>
	<option value="Montserrat">Montserrat</option>
	<option value="Morocco">Morocco</option>
	<option value="Mozambique">Mozambique</option>
	<option value="Myanmar">Myanmar</option>
	<option value="Namibia">Namibia</option>
	<option value="Nauru">Nauru</option>
	<option value="Nepal">Nepal</option>
	<option value="Netherlands">Netherlands</option>
	<option value="Netherlands Antilles">Netherlands Antilles</option>
	<option value="New Caledonia">New Caledonia</option>
	<option value="New Zealand">New Zealand</option>
	<option value="Nicaragua">Nicaragua</option>
	<option value="Niger">Niger</option>
	<option value="Nigeria">Nigeria</option>
	<option value="Niue">Niue</option>
	<option value="Norfolk Island">Norfolk Island</option>
	<option value="Northern Mariana Islands">Northern Mariana Islands</option>
	<option value="Norway">Norway</option>
	<option value="Oman">Oman</option>
	<option value="Pakistan">Pakistan</option>
	<option value="Palau">Palau</option>
	<option value="Panama">Panama</option>
	<option value="Papua New Guinea">Papua New Guinea</option>
	<option value="Paraguay">Paraguay</option>
	<option value="Peru">Peru</option>
	<option value="Philippines">Philippines</option>
	<option value="Pitcairn">Pitcairn</option>
	<option value="Poland">Poland</option>
	<option value="Portugal">Portugal</option>
	<option value="Puerto Rico">Puerto Rico</option>
	<option value="Qatar">Qatar</option>
	<option value="Reunion">Reunion</option>
	<option value="Romania">Romania</option>
	<option value="Russia">Russian Federation</option>
	<option value="Rwanda">Rwanda</option>
	<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
	<option value="Saint LUCIA">Saint LUCIA</option>
	<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
	<option value="Samoa">Samoa</option>
	<option value="San Marino">San Marino</option>
	<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
	<option value="Saudi Arabia">Saudi Arabia</option>
	<option value="Senegal">Senegal</option>
	<option value="Seychelles">Seychelles</option>
	<option value="Sierra">Sierra Leone</option>
	<option value="Singapore">Singapore</option>
	<option value="Slovakia">Slovakia (Slovak Republic)</option>
	<option value="Slovenia">Slovenia</option>
	<option value="Solomon Islands">Solomon Islands</option>
	<option value="Somalia">Somalia</option>
	<option value="South Africa">South Africa</option>
	<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
	<option value="Span">Spain</option>
	<option value="SriLanka">Sri Lanka</option>
	<option value="St. Helena">St. Helena</option>
	<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
	<option value="Sudan">Sudan</option>
	<option value="Suriname">Suriname</option>
	<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
	<option value="Swaziland">Swaziland</option>
	<option value="Sweden">Sweden</option>
	<option value="Switzerland">Switzerland</option>
	<option value="Syria">Syrian Arab Republic</option>
	<option value="Taiwan">Taiwan, Province of China</option>
	<option value="Tajikistan">Tajikistan</option>
	<option value="Tanzania">Tanzania, United Republic of</option>
	<option value="Thailand">Thailand</option>
	<option value="Togo">Togo</option>
	<option value="Tokelau">Tokelau</option>
	<option value="Tonga">Tonga</option>
	<option value="Trinidad and Tobago">Trinidad and Tobago</option>
	<option value="Tunisia">Tunisia</option>
	<option value="Turkey">Turkey</option>
	<option value="Turkmenistan">Turkmenistan</option>
	<option value="Turks and Caicos">Turks and Caicos Islands</option>
	<option value="Tuvalu">Tuvalu</option>
	<option value="Uganda">Uganda</option>
	<option value="Ukraine">Ukraine</option>
	<option value="United Arab Emirates">United Arab Emirates</option>
	<option value="United Kingdom">United Kingdom</option>
	<option value="United States">United States</option>
	<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
	<option value="Uruguay">Uruguay</option>
	<option value="Uzbekistan">Uzbekistan</option>
	<option value="Vanuatu">Vanuatu</option>
	<option value="Venezuela">Venezuela</option>
	<option value="Vietnam">Viet Nam</option>
	<option value="Virgin Islands (British)">Virgin Islands (British)</option>
	<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
	<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
	<option value="Western Sahara">Western Sahara</option>
	<option value="Yemen">Yemen</option>
	<option value="Yugoslavia">Yugoslavia</option>
	<option value="Zambia">Zambia</option>
	<option value="Zimbabwe">Zimbabwe</option>
</select></div>
<?php }
function __hook_company_country($country){
	echo '<div class="col-lg-8">
<select class="form-control" name="u_comapny_country" id="u_comapny_country">';
if(!empty($country) && $country!='Vælg'):
	echo "<option value='$country' selected>$country</option>";
	else:
	$character = htmlspecialchars("Vælg", ENT_QUOTES);
	
		echo'<option value="Vælg" selected>'.$character.'</option>';
	endif;?>
	<option value="Afghanistan">Afghanistan</option>
	<option value="Albania">Albania</option>
	<option value="Algeria">Algeria</option>
	<option value="American Samoa">American Samoa</option>
	<option value="Andorra">Andorra</option>
	<option value="Angola">Angola</option>
	<option value="Anguilla">Anguilla</option>
	<option value="Antartica">Antarctica</option>
	<option value="Antigua and Barbuda">Antigua and Barbuda</option>
	<option value="Argentina">Argentina</option>
	<option value="Armenia">Armenia</option>
	<option value="Aruba">Aruba</option>
	<option value="Australia">Australia</option>
	<option value="Austria">Austria</option>
	<option value="Azerbaijan">Azerbaijan</option>
	<option value="Bahamas">Bahamas</option>
	<option value="Bahrain">Bahrain</option>
	<option value="Bangladesh">Bangladesh</option>
	<option value="Barbados">Barbados</option>
	<option value="Belarus">Belarus</option>
	<option value="Belgium">Belgium</option>
	<option value="Belize">Belize</option>
	<option value="Benin">Benin</option>
	<option value="Bermuda">Bermuda</option>
	<option value="Bhutan">Bhutan</option>
	<option value="Bolivia">Bolivia</option>
	<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
	<option value="Botswana">Botswana</option>
	<option value="Bouvet Island">Bouvet Island</option>
	<option value="Brazil">Brazil</option>
	<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
	<option value="Brunei Darussalam">Brunei Darussalam</option>
	<option value="Bulgaria">Bulgaria</option>
	<option value="Burkina Faso">Burkina Faso</option>
	<option value="Burundi">Burundi</option>
	<option value="Cambodia">Cambodia</option>
	<option value="Cameroon">Cameroon</option>
	<option value="Canada">Canada</option>
	<option value="Cape Verde">Cape Verde</option>
	<option value="Cayman Islands">Cayman Islands</option>
	<option value="Central African Republic">Central African Republic</option>
	<option value="Chad">Chad</option>
	<option value="Chile">Chile</option>
	<option value="China">China</option>
	<option value="Christmas Island">Christmas Island</option>
	<option value="Cocos Islands">Cocos (Keeling) Islands</option>
	<option value="Colombia">Colombia</option>
	<option value="Comoros">Comoros</option>
	<option value="Congo">Congo</option>
	<option value="Congo">Congo, the Democratic Republic of the</option>
	<option value="Cook Islands">Cook Islands</option>
	<option value="Costa Rica">Costa Rica</option>
	<option value="Cota D'Ivoire">Cote d'Ivoire</option>
	<option value="Croatia">Croatia (Hrvatska)</option>
	<option value="Cuba">Cuba</option>
	<option value="Cyprus">Cyprus</option>
	<option value="Czech Republic">Czech Republic</option>
	<option value="Denmark">Denmark</option>
	<option value="Djibouti">Djibouti</option>
	<option value="Dominica">Dominica</option>
	<option value="Dominican Republic">Dominican Republic</option>
	<option value="East Timor">East Timor</option>
	<option value="Ecuador">Ecuador</option>
	<option value="Egypt">Egypt</option>
	<option value="El Salvador">El Salvador</option>
	<option value="Equatorial Guinea">Equatorial Guinea</option>
	<option value="Eritrea">Eritrea</option>
	<option value="Estonia">Estonia</option>
	<option value="Ethiopia">Ethiopia</option>
	<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
	<option value="Faroe Islands">Faroe Islands</option>
	<option value="Fiji">Fiji</option>
	<option value="Finland">Finland</option>
	<option value="France">France</option>
	<option value="France Metropolitan">France, Metropolitan</option>
	<option value="French Guiana">French Guiana</option>
	<option value="French Polynesia">French Polynesia</option>
	<option value="French Southern Territories">French Southern Territories</option>
	<option value="Gabon">Gabon</option>
	<option value="Gambia">Gambia</option>
	<option value="Georgia">Georgia</option>
	<option value="Germany">Germany</option>
	<option value="Ghana">Ghana</option>
	<option value="Gibraltar">Gibraltar</option>
	<option value="Greece">Greece</option>
	<option value="Greenland">Greenland</option>
	<option value="Grenada">Grenada</option>
	<option value="Guadeloupe">Guadeloupe</option>
	<option value="Guam">Guam</option>
	<option value="Guatemala">Guatemala</option>
	<option value="Guinea">Guinea</option>
	<option value="Guinea-Bissau">Guinea-Bissau</option>
	<option value="Guyana">Guyana</option>
	<option value="Haiti">Haiti</option>
	<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
	<option value="Holy See">Holy See (Vatican City State)</option>
	<option value="Honduras">Honduras</option>
	<option value="Hong Kong">Hong Kong</option>
	<option value="Hungary">Hungary</option>
	<option value="Iceland">Iceland</option>
	<option value="India">India</option>
	<option value="Indonesia">Indonesia</option>
	<option value="Iran">Iran (Islamic Republic of)</option>
	<option value="Iraq">Iraq</option>
	<option value="Ireland">Ireland</option>
	<option value="Israel">Israel</option>
	<option value="Italy">Italy</option>
	<option value="Jamaica">Jamaica</option>
	<option value="Japan">Japan</option>
	<option value="Jordan">Jordan</option>
	<option value="Kazakhstan">Kazakhstan</option>
	<option value="Kenya">Kenya</option>
	<option value="Kiribati">Kiribati</option>
	<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
	<option value="Korea">Korea, Republic of</option>
	<option value="Kuwait">Kuwait</option>
	<option value="Kyrgyzstan">Kyrgyzstan</option>
	<option value="Lao">Lao People's Democratic Republic</option>
	<option value="Latvia">Latvia</option>
	<option value="Lebanon">Lebanon</option>
	<option value="Lesotho">Lesotho</option>
	<option value="Liberia">Liberia</option>
	<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
	<option value="Liechtenstein">Liechtenstein</option>
	<option value="Lithuania">Lithuania</option>
	<option value="Luxembourg">Luxembourg</option>
	<option value="Macau">Macau</option>
	<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
	<option value="Madagascar">Madagascar</option>
	<option value="Malawi">Malawi</option>
	<option value="Malaysia">Malaysia</option>
	<option value="Maldives">Maldives</option>
	<option value="Mali">Mali</option>
	<option value="Malta">Malta</option>
	<option value="Marshall Islands">Marshall Islands</option>
	<option value="Martinique">Martinique</option>
	<option value="Mauritania">Mauritania</option>
	<option value="Mauritius">Mauritius</option>
	<option value="Mayotte">Mayotte</option>
	<option value="Mexico">Mexico</option>
	<option value="Micronesia">Micronesia, Federated States of</option>
	<option value="Moldova">Moldova, Republic of</option>
	<option value="Monaco">Monaco</option>
	<option value="Mongolia">Mongolia</option>
	<option value="Montserrat">Montserrat</option>
	<option value="Morocco">Morocco</option>
	<option value="Mozambique">Mozambique</option>
	<option value="Myanmar">Myanmar</option>
	<option value="Namibia">Namibia</option>
	<option value="Nauru">Nauru</option>
	<option value="Nepal">Nepal</option>
	<option value="Netherlands">Netherlands</option>
	<option value="Netherlands Antilles">Netherlands Antilles</option>
	<option value="New Caledonia">New Caledonia</option>
	<option value="New Zealand">New Zealand</option>
	<option value="Nicaragua">Nicaragua</option>
	<option value="Niger">Niger</option>
	<option value="Nigeria">Nigeria</option>
	<option value="Niue">Niue</option>
	<option value="Norfolk Island">Norfolk Island</option>
	<option value="Northern Mariana Islands">Northern Mariana Islands</option>
	<option value="Norway">Norway</option>
	<option value="Oman">Oman</option>
	<option value="Pakistan">Pakistan</option>
	<option value="Palau">Palau</option>
	<option value="Panama">Panama</option>
	<option value="Papua New Guinea">Papua New Guinea</option>
	<option value="Paraguay">Paraguay</option>
	<option value="Peru">Peru</option>
	<option value="Philippines">Philippines</option>
	<option value="Pitcairn">Pitcairn</option>
	<option value="Poland">Poland</option>
	<option value="Portugal">Portugal</option>
	<option value="Puerto Rico">Puerto Rico</option>
	<option value="Qatar">Qatar</option>
	<option value="Reunion">Reunion</option>
	<option value="Romania">Romania</option>
	<option value="Russia">Russian Federation</option>
	<option value="Rwanda">Rwanda</option>
	<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
	<option value="Saint LUCIA">Saint LUCIA</option>
	<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
	<option value="Samoa">Samoa</option>
	<option value="San Marino">San Marino</option>
	<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
	<option value="Saudi Arabia">Saudi Arabia</option>
	<option value="Senegal">Senegal</option>
	<option value="Seychelles">Seychelles</option>
	<option value="Sierra">Sierra Leone</option>
	<option value="Singapore">Singapore</option>
	<option value="Slovakia">Slovakia (Slovak Republic)</option>
	<option value="Slovenia">Slovenia</option>
	<option value="Solomon Islands">Solomon Islands</option>
	<option value="Somalia">Somalia</option>
	<option value="South Africa">South Africa</option>
	<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
	<option value="Span">Spain</option>
	<option value="SriLanka">Sri Lanka</option>
	<option value="St. Helena">St. Helena</option>
	<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
	<option value="Sudan">Sudan</option>
	<option value="Suriname">Suriname</option>
	<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
	<option value="Swaziland">Swaziland</option>
	<option value="Sweden">Sweden</option>
	<option value="Switzerland">Switzerland</option>
	<option value="Syria">Syrian Arab Republic</option>
	<option value="Taiwan">Taiwan, Province of China</option>
	<option value="Tajikistan">Tajikistan</option>
	<option value="Tanzania">Tanzania, United Republic of</option>
	<option value="Thailand">Thailand</option>
	<option value="Togo">Togo</option>
	<option value="Tokelau">Tokelau</option>
	<option value="Tonga">Tonga</option>
	<option value="Trinidad and Tobago">Trinidad and Tobago</option>
	<option value="Tunisia">Tunisia</option>
	<option value="Turkey">Turkey</option>
	<option value="Turkmenistan">Turkmenistan</option>
	<option value="Turks and Caicos">Turks and Caicos Islands</option>
	<option value="Tuvalu">Tuvalu</option>
	<option value="Uganda">Uganda</option>
	<option value="Ukraine">Ukraine</option>
	<option value="United Arab Emirates">United Arab Emirates</option>
	<option value="United Kingdom">United Kingdom</option>
	<option value="United States">United States</option>
	<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
	<option value="Uruguay">Uruguay</option>
	<option value="Uzbekistan">Uzbekistan</option>
	<option value="Vanuatu">Vanuatu</option>
	<option value="Venezuela">Venezuela</option>
	<option value="Vietnam">Viet Nam</option>
	<option value="Virgin Islands (British)">Virgin Islands (British)</option>
	<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
	<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
	<option value="Western Sahara">Western Sahara</option>
	<option value="Yemen">Yemen</option>
	<option value="Yugoslavia">Yugoslavia</option>
	<option value="Zambia">Zambia</option>
	<option value="Zimbabwe">Zimbabwe</option>
</select></div>
<?php }
function __hook_company_type($table , $id){
echo '<div class="col-lg-8">
	<select class="form-control" name="u_comp_type" id="u_comp_type">';
	$id = get_row($table, "where id = $id");
		if(mysql_num_rows($id) > 0){
				$data 		= mysql_fetch_assoc($id);
				$id   		= $data['id'];
				$ent_name 	= $data['name'];
				echo "<option value='$id' selected>$ent_name</option>";
				
		}else{
				echo "<option value='5' selected>Vælg</option>";
		
		}
		echo '<option value="1">I/S</option>
		<option value="2">ApS</option>
		<option value="3">IVS</option>
		<option value="4">A/S</option>
	</select>
</div>';
}
function __hook_num_of_employes($company_no_of_emp){
echo'<div class="col-lg-8">
	<select class="form-control" id="u_comapny_no_of_emp" name="u_comapny_no_of_emp">';
	if(strlen($company_no_of_emp) > 0 && $company_no_of_emp!=NULL && $company_no_of_emp!='0'){
				echo "<option value='$company_no_of_emp' selected>$company_no_of_emp</option>";
		}else{
			echo "<option value='0' selected>Vælg</option>";
		
		}
	for($emp = 1 ; $emp <=100 ; $emp++ ){
		echo "<option value=".$emp.">".$emp."</option>";
	}
echo'</select>
</div>';
}

function __hooke_weekly_hours($hours_status){
	if($hours_status=='Fuldtid'){
        echo '<div class="col-lg-3 col-xs-6">
		<div class="radio radio-primary">
            <p><input type="radio" name="no_of_hours_week" id="hoursfuldtid" value="Fuldtid" checked>
				<label for="hoursfuldtid">		
					&nbsp;&nbsp;Fuldtid</p></div>
        </div>';
        echo '<div class="col-lg-3 col-xs-6"><div class="radio radio-primary">
            <p><input type="radio" name="no_of_hours_week" id="hoursdltid" value="Deltid">
				<label for="hoursdltid">&nbsp;Deltid</label></p></div>
        </div>';
    }if($hours_status=='Deltid'){
       echo '<div class="col-lg-3 col-xs-6">
		<div class="radio radio-primary">
            <p><input type="radio" name="no_of_hours_week" id="hoursdltid" value="Fuldtid" >
				<label for="hoursdltid">&nbsp;&nbsp;Fuldtid</p></div>
        </div>';
        echo '<div class="col-lg-3 col-xs-6"><div class="radio radio-primary">
            <p><input type="radio" name="no_of_hours_week" id="hoursfuldtid" value="Deltid" checked>
			<label for="hoursfuldtid">&nbsp;Deltid</label></p></div>
        </div>';
    }else if($hours_status!='Fuldtid' && $hours_status!='Deltid'){
      echo '<div class="col-lg-3 col-xs-6">
		<div class="radio radio-primary">
            <p><input type="radio" name="no_of_hours_week" id="hoursdltid" value="Fuldtid" >
				<label for="hoursdltid">&nbsp;&nbsp;Fuldtid</p></div>
        </div>';
        echo '<div class="col-lg-3 col-xs-6"><div class="radio radio-primary">
            <p><input type="radio" name="no_of_hours_week" id="hoursfuldtid" value="Deltid">
			<label for="hoursfuldtid">&nbsp;&nbsp;Deltid</label></p></div>
        </div>';
    }
}
function HandleLogin(){
    
    
}




?>
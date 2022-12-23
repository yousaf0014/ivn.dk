<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
class SandGrid{	
  public function sandgrid($data){		
    $request =  'contactdb/recipients';
    $params = array(array(
    'email' => $data['email'],
    'first_name' => $data['first_name'],
    'last_name' => $data['last_name']
    ));
    $json_post_fields = json_encode($params);
    $data = $this->__curlRequest($json_post_fields,$request);
    dd($data);
  }

  public function __curlRequest($json_post_fields, $request){
    $url = 'https://api.sendgrid.com/v3/';
    $request = $url.$request;
    echo $request;
    $ch = curl_init();
    $headers = array("Content-Type: application/json","Authorization:Bearer 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");
    echo '<pre>';
    print_r($headers);
    curl_setopt($ch, CURLOPT_POST, true);   
    curl_setopt($ch, CURLOPT_URL, $request);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // Apply the JSON to our curl call
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_post_fields);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
      print "Error: " . curl_error($ch);
    } else {
      // Show me the result
      curl_close($ch);
    }
    dd($data);
    return $data;
  }
}
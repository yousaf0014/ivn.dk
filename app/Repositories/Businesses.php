<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\UserAdvert;
use Mail;

class Businesses{	
	
	public function cancleUserBusiness(User $user){
		$businessAdvert = new UserAdvert;
		$userArray  = $user->toArray();
        $businessSubscribed = $businessAdvert->where('user_id',$user->id)->where('active',1)->get();
        foreach($businessSubscribed as $BS){
        	$BS->active = 0;
        	$BS->save();
        	$businessData = User::find($BS->business_user_id);
        	Mail::send('emails.cancelBusinessSubscription',$userArray,function($message) use ($businessData){            
	            $message->to($businessData->email)->subject('Ændring af brugerabonnement hos IVN')
	            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
	        });
	        if( count(Mail::failures()) > 0 ) {
	            flash('Error signup.','error');
	            continue;
	        }	    
        }
        return true;
	}
}
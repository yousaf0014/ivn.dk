<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Repositories\Reepay;
use App\Repositories\Businesses;

class NotifyNonPaidUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotifyNonPaidUsers:ReportInActiveUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report Users that have stoped Paying';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::get();
        $businessObj = new Businesses;
        $reepay = new Reepay;

        foreach($users as $user){
            if(empty($user->handle)){
                continue;
            }
            $handel = $user->handle;
            
            if(!in_array($user->id,array(1,17,188,189,256,260,261,264,173,188,189,216,238))){
                $susbscription = $reepay->checkSubscription($handel);
                
                if($susbscription == false){                
                    $user->user_subscription = 'level1';
                    $user->save();
                    $businessObj->cancleUserBusiness($user);
                }else if($susbscription['state'] == 'expired'){
                   $user->user_subscription = 'level1';
                   $user->save();
                   $businessObj->cancleUserBusiness($user);
                }
            }
        }
    }
}
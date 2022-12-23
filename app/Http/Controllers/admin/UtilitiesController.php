<?php
namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\PostReport;
use App\CommentReport;
use App\Post;
use App\User;
use App\PostComment;
use App\ContactUs;
use Carbon\Carbon;
use Session;
use Auth;
use Mail;

class UtilitiesController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		 
	}
	
	/**
	 * List users
	 * @return unknown
	 */


	public function contects(Request $request)
	{
		$contactObj = new ContactUs;
		$keyword = '';
		$active = '-1';
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $contactObj = $contactObj->Where('first_name', 'like', '%'.$keyword.'%');
            $contactObj = $contactObj->orWhere('last_name', 'like', '%'.$keyword.'%');
            $contactObj = $contactObj->orWhere('email', 'like', '%'.$keyword.'%');
            $contactObj = $contactObj->orWhere('details', 'like', '%'.$keyword.'%');
        }
        if(isset($request->active) && $request->active != -1){
        	$active = $request->active;
        	$contactObj = $contactObj->Where('active', $request->active);
        }
        $contacts = $contactObj->paginate(10);
        return view('admin.utilities.contects',compact('contacts','keyword','active'));
	}

	public function changeStatus(ContactUs $contact,$status){
        $contact->active = $status;
        $contact->save();
        flash('Successfully Deactivated!','success');
        return back();
    }

    public function showDetails(ContactUs $contact){
        return view('admin.utilities.show',compact('contact'));
        return back();
    }

    public function deleteContactUs(ContactUs $contact){
        $contact->delete();
        flash('Successfully deleted the contactus!','success');
        return back();
    }

    public function postReports(Request $request)
    {
        $postReportObj = new PostReport;
        $keyword = '';
        $active = '-1';
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $postReportObj = $postReportObj->Where('active', $request->active);
        }
        $reports = $postReportObj->with('user')->with('post')->paginate(10);
        return view('admin.utilities.reports',compact('reports','keyword','active'));
    }

    public function changeReportStatus(PostReport $report,$status){
        $report->active = $status;
        $report->save();
        flash('Successfully Deactivated!','success');
        return back();
    }

    public function showReportDetails(PostReport $report){
        $user = $report->user()->first();
        $post = $report->post()->first();
        return view('admin.utilities.showReport',compact('report','user','post'));
    }

    public function deleteReport(PostReport $report){
        $report->delete();
        flash('Successfully deleted the contactus!','success');
        return back();
    }

    public function deactivePost(Post $post,$status){
        $post->active = $status;
        $post->save();
        flash('Successfully Deactivated Post!','success');
        return back();
    }

    public function commentReports(Request $request)
    {
        $commentReportObj = new CommentReport;
        $keyword = '';
        $active = '-1';
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $commentReportObj = $commentReportObj->Where('active', $request->active);
        }
        $creports = $commentReportObj->with('user')->with('comment')->paginate(10);
        return view('admin.utilities.comment_reports',compact('creports','keyword','active'));
    }

    public function changeCommentReportStatus(CommentReport $comment,$status){
        $comment->active = $status;
        $comment->save();
        flash('Successfully Deactivated!','success');
        return back();
    }

    public function showCommentReportDetails(CommentReport $comment){
        $user = $comment->user()->first();
        $commentD = $comment->comment()->first();
        return view('admin.utilities.showCommentReport',compact('commentD','user','comment'));
    }

    public function deleteCommentReport(CommentReport $comment){
        $comment->delete();
        flash('Successfully deleted the contactus!','success');
        return back();
    }

    public function deactiveComment(PostComment $comment,$status){
        $comment->active = $status;
        $comment->save();
        flash('Successfully Deactivated Comment!','success');
        return back();
    }

    public function listDeleteUsers(Request $request){
        $userObj = new User;
        $users = $userObj->where('active',0)->where('delete_me',1)->paginate(20);
        return view('admin.utilities.listDeleteUser',compact('users'));
    }

    public function deleteUser(User $user){
        // Delete User send email. make sql file and other things needs to be done here.
        $data = $user->toArray();
        $flag = $this->backupDatabase();
        if($flag && $user->delete()){
            Mail::send('emails.user_deleted',$data ,function($message) use ($data){
                $message->to($data['email'])->subject('Din mail bliver slettet')
                ->from(config('constants.NO_REPLY_EMAIL'))->bcc('yousaf@logicso.tech');
            });

            Mail::send('emails.profile_deleted',$data ,function($message) use ($data){
                $message->to($data['email'])->subject('Din profil på IVN.dk er nu blevet slettet')
                ->from(config('constants.NO_REPLY_EMAIL'))->bcc('yousaf@logicso.tech');
            });
            flash('Successfully Deleted.','success');
            return back();    
        }

        flash('Error in deleting.','error');
        return back();

    }

    public function backupDatabase(){
        return true;
    }

}

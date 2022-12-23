<div class="single-post-comment">
	<div class="tp-post">
		<div class="comment-by">
			<div class="commntr-img">
				<?php if(!empty(Auth::user()->profile_image)){ ?>
                	<img src="{{ asset('uploads/profile/'.Auth::user()->profile_image) }}" alt="{{Auth::user()->first_name.' '.Auth::user()->last_name}}">
            	<?php } ?>
			</div>
			<div class="commntr-dt">
				<div class="name">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</div>
				<div class="desc">{{!empty($company) ? $company->name:''}}</div>
			</div>
		</div>
		

		<div class="report-post">
			<div class="btnRportPost">
				<img src="{{asset('images/icons/ivn-report-post-btn.png')}}">
			 </div>
			<div class="links-report-post">
				<a href="javascript:;" onclick="reportComment('<?php echo $commnets->id; ?>')">Report Comment</a>
				<a href="{{url('user/editcomment/'.$commnets->id.'/edit')}}" title="Edit Comment" class="edit comment">Edit Comment</a>
            	<a href="{{url('user/delete',$commnets->id)}}" title="Delete Comment">
                	Delete Comment
                </a>
			</div>
		</div>		
		<div class="comment-date" style="padding-right:5px;">{{postTime($commnets->created_at)}}</div>
	</div>
	
	<?php $string = substr(strip_tags(html_entity_decode($commnets->comment),'<br><b>'),0); ?>
	<?php if(strlen($string) > 200){ ?>
	<div class="comment-msg comment_{{$commnets->id}}">
		<?php echo shortString($commnets->comment,200); ?>
		<a href="javascript:;" onclick="$('.comment_{{$commnets->id}}').toggle();" class="view-details">Læs mere</a>		
	</div>
	<?php }else{ ?>
		<div class="comment-msg comment_{{$commnets->id}}">
			<?php echo $commnets->comment; ?>
		</div>
	<?php } ?>
	<div class="comment-msg comment_{{$commnets->id}}" style="display:none">
		<?php echo $commnets->comment; ?>
	</div>
	<?php if(!empty($commnets->image_path)){ ?>
		<div class="imageBox clearfix text-center" style="padding-bottom:15px;">
			<img src="{{asset('uploads/Comment/'.$commnets->image_path)}}" class="img-responsive" alt="">
		</div>
	<?php } ?>

	<div class="comment-rating">
		<button class="btn-ivn-post-rating-mns" onclick="rateComment('minus',{{$commnets->id}})"><img src="{{asset('images/icons/ic-post-vote-mins.png')}}" alt="post mins" ></button>
		<div class="totle-votes" id="comment_count_{{$commnets->id}}">0</div>
		<img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="comment_img_{{$commnets->id}}">
		<button class="btn-ivn-post-rating-plus" onclick="rateComment('plus',{{$commnets->id}})"><img src="{{asset('images/icons/ic-post-vote-plus.png')}}" alt="post plus"></button>
		
	</div> <!-- post-rating end -->
</div> <!-- single-post-comment end -->
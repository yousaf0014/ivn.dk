<script type="text/javascript">
var currentPost = 0;
    function readURL(obj) {
        var p = $(obj).parent().parent();
        if (obj.files && obj.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                p.find(".showSelectedImage img").attr('src', e.target.result);
                p.find(".showSelectedImage").show();
            };
            reader.readAsDataURL(obj.files[0]);
        }
    }
    function loadMoreComments(elem,postID){
        //post_comments+postID
        var page = $('#comment_'+postID+'_page').val()*1+1;
        $(elem).hide();
        $('#comment_load_'+postID).show();
        $.ajax({
            url: "{{url('/getComments/')}}",
            type: "GET",
            data: {post:postID,page:page},
            success: function(res){
                $('#comment_load_'+postID).hide();
                if(res.trim() != ''){
                    $('#comment_box_'+postID).append(res);
                    $('#comment_'+postID+'_page').val(page);
                    //$('#myFormId').resetForm();
                    var options = { 
                        success:       showResponse  // post-submit callback     
                    }; 
                    // bind form using 'ajaxForm' 
                    $('#comment_box_'+postID+' .ajax_form').ajaxForm(options);
                    $(elem).show();
                    changeColor(postID);
                    $(".btnRportPost").on('click','img',function(){
                        $(this).toggleClass("active");
                        $(this).parent().parent().find(".links-report-post").toggleClass("active");

                    });
                }else{
                    $('#comment_load_'+postID).hide();       
                }
            }

        });
    }

    function changeColor(postID){
        var index = 0;
        $('#post_comments'+postID+ ' .altrow').removeClass('altrow');
        $('#post_comments'+postID+ ' .single-post-comment').each(function(){
            if(index%2 == 0){
                $(this).addClass('altrow');
            }
            index++;
        });
    }
    function showResponse(responseText, statusText, xhr, $form)  { 
 		$('#comment_box_'+currentPost).append(responseText);
        $('#comment_ajax_'+currentPost+' input').val('');
        $('#comment_ajax_'+currentPost+' textarea').val('');

        $('#comment_box_'+currentPost).find('div.single-post-comment:last .btnRportPost').on('click','img',function(){
            $(this).toggleClass("active");
            $(this).parent().parent().find(".links-report-post").toggleClass("active");
        });

    }
    var commentflag = 0; 
    function checkEnter(post,event,elem){
        if(event.keyCode == 13 && ( event.ctrlKey || event.shiftKey)) {
            $(elem).val($(elem).val()+'\n');
        }else if(event.keyCode == 13 && !(event.ctrlKey || event.shiftKey)){
    		currentPost = post;
			$(elem).text('<?php cmskey("Pleasae wait ...");?>');
            if(commentflag == 0){
                commentflag = post;
                var text = $('#comment_ajax_'+post+' textarea').val($('#comment_ajax_'+post+' textarea').val().replace(/\n/g, '<br/>'));
                text1 = $(text).val();
                if( text1.trim() != ''){
                    $('#comment_ajax_'+post).submit();
                    $('#comment_ajax_'+post+' input').val('');
                    $('#comment_ajax_'+post+' textarea').val('');
                }
                commentflag = 0;
            }
            var commentCount = $('#comment_count_'+post+' span').text()*1;
            $('#comment_count_'+post+' span').text(commentCount+1);
            changeColor(post);
    	}
    }

 	function subscibeToNetwork(network){
 		$.ajax({
            url: "{{url('/subscribeNetwork/1')}}",
            type: "post",
            data: {network:network},
            success: function(res){
            	if(res.trim() == 'true'){
            		$('#network_'+network+'_sub').hide();
                    $('#network_'+network+'_unsub').show();
            	}else{
	            	alert('Please try again');
                }
            }
        });
 	}

    function makeUnscribe(network){
        $.ajax({
            url: "{{url('/subscribeNetwork/0')}}",
            type: "post",
            data: {network:network},
            success: function(res){
                if(res.trim() == 'true'){
                    $('#network_'+network+'_sub').show();
                    $('#network_'+network+'_unsub').hide();
                }else{
                    alert('Please try again');
                }
            }
        });
    }

 	function reportPost(postID){
 		$.ajax({
            url: "{{url('/ReportPost')}}",
            type: "post",
            data: {post:postID},
            success: function(res){
            	if(res.trim() == 'true'){
            		//$('.network_'+network).remove();            		
            		alert("<?php echo cmskey('Post_Reported_success');?>");
            	}else{
                    alert("<?php echo cmskey('post_Reported_failure');?>");
                }
            }
        });
 	}

 	function reportComment(commentID){
 		$.ajax({
            url: "{{url('/ReportComment')}}",
            type: "post",
            data: {comment:commentID},
            success: function(res){
            	if(res.trim() == 'true'){
            		alert("<?php echo cmskey('Commnet_Reported_success');?>");
            	}else{
                    alert("<?php echo cmskey('Commnet_Reported_failure');?>");
                }
            }
        });
 	}
 	
    
    function hideLoadmoreMessage(elemid){
    	$('#'+elemid).hide();
    }
    function hideModal(){
        jQuery('#editPostPopup').modal('hide');
    }
    $(document).ready(function(){
    	$.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('#crf_token').val() }
        });

        //$('#myFormId').resetForm();
	 	var options = { 
	        success:       showResponse  // post-submit callback 	 
	    }; 
	 
	    // bind form using 'ajaxForm' 
	    $('.ajax_form').ajaxForm(options);

        
        $("#editPostPopup").on("show.bs.modal", function(e) {
            url =  $(e.relatedTarget).data('target-url');
            $.get( url , function( data ) {
                $(".vm-layout").html(data);
            });

        });
    });
    
    function ratePost(operator,post){
        var rate = 1;
        $('#post_count_'+post).hide();
        $('#post_img_'+post).show();
        var ratings = $('#post_count_'+post).text()*1;
        if(operator == 'minus'){
            rate = -1;            
        }
        $.ajax({
            url: "{{url('/user/ratepost')}}",
            type: "post",
            data: {post:post,rate:rate},
            success: function(res){
                $('#post_img_'+post).hide();
                $('#post_count_'+post).show();
                if(res != 'false'){
                    $('#post_count_'+post).text(res);
                }
            }
        });
    }


    function rateComment(operator,comment){
        var rate = 1;
        
        $('#comment_count_'+comment).hide();
        $('#comment_img_'+comment).show();
        var ratings = $('#comment_count_'+comment).text()*1;
        if(operator == 'minus'){
            rate = -1;
        }
        $.ajax({
            url: "{{url('/user/ratecomment')}}",
            type: "post",
            data: {comment:comment,rate:rate},
            success: function(res){
                $('#comment_img_'+comment).hide();
                $('#comment_count_'+comment).show();
                if(res != 'false'){
                    $('#comment_count_'+comment).text(res);
                }
            }
        });
    }
</script>
@extends('layouts.admin.app')
<!-- if there are creation errors, they will show here -->
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="category" style="padding:15px 10px;">
        <?php if(!empty($postData['networks'])){
            foreach($postData['networks'] as $network){
               echo $network->category->title.'\\'.$network->title.'<br/>';
            }
        } ?>
    </div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="col-lg-10">
                  <!-- Title -->
                  <h1 class="mt-4">{{$postData['post']->title}}</h1>
                </div>
                <div class="col-lg-2">
                    <h1>
                        <a href="javascript:;" onclick="ratePost('minus')">-</a>
                        <span class="count" id="post_count">
                            {{empty($postData['postRatings'][0]->user_ratings) ? 0:$postData['postRatings'][0]->user_ratings}}                            
                        </span>
                        <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="post_img">
                        <a href="javascript:;" onclick="ratePost('plus')">+</a>
                    </h1>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div style="padding:20px;">
                    <input type="hidden" id="post_id" value="{{$postData['post']->id}}">
                    <?php if($postData['post']->image_path){?>
                    <img class="img-fluid rounded" src="{{ asset('uploads/post/' . $postData['post']->image_path) }}" alt="">
                    <?php } ?>
                    <div class="post-content">
                        <!-- Post Content -->
                        <p>
                           <?php  echo html_entity_decode($postData['post']->details) ?>
                        </p>
                        <div class="user-info" style="margin:auto;text-align:center">
                            <img width="100" class="img-circle" src="{{ asset('uploads/profile/'.$postData['createdBY'][0]->profile_image) }}" alt="{{ $postData['createdBY'][0]->first_name.' '.$postData['createdBY'][0]->last_name }}">
                            <h2>{{ $postData['createdBY'][0]->first_name.' '.$postData['createdBY'][0]->last_name }}</h2>
                        <div>                        
                    </div>
                    <!-- Comments Form -->

                    <hr />
                    <div class="col-lg-10">
                        <div class="pull-left"><h1>{{!empty($postData['postComments'][0]->post_id) ? $postData['postComments']->count():0}}</h1></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-2">
                        <a data-target-url="{{url('admin/Post/postCommnet/'.$postData['post']->id.'/0')}}" href="javascript:;" data-toggle="modal" data-target-id="{{$postData['post']->id}}" data-target="#myModal" class="glyphicon glyphicon-edit edit_info" title="Add Comment">Comment</a>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                    foreach($postData['postComments'] as $commnets){
                            if(!empty($commnets->comment_id)){
                        ?>
                        <div class="post_comment">
                            <div class="media mb-4">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <?php if($commnets->image_path){ ?>
                                            <img width="50" class="img-circle" src="{{ asset('uploads/profile/'.$commnets->profile_image) }}" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="media-body">
                                            <div class="pull-left"><h5 class="mt-0">{{$commnets->first_name.' '.$commnets->last_name}}</h5></div>
                                            <div class="pull-right">
                                                <?php if($commnets->user_id == Auth::user()->id){?>
                                                <a data-target-url="{{url('admin/Post/postCommnet/'.$postData['post']->id.'/'.$commnets->id)}}" href="javascript:;" data-toggle="modal" data-target-id="{{$postData['post']->id}}" data-target="#myModal" class="edit_info" title="Edit Comment">
                                                    <span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
                                                <a href="{{url('admin/Post/deleteComment/'.$commnets->id)}}/0" title="Delete">
                                                    <span class="glyphicon glyphicon-remove mr5"></span>
                                                </a> &nbsp;
                                               <?php } ?> 
                                            </div>
                                            <div class="clearfix"></div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pull-left">
                                        <?php if($commnets->image_path) {?>
                                            <img class="img-fluid rounded" height="250" src="{{ asset('uploads/Comment/' . $commnets->image_path) }}" alt="">
                                        <?php } ?>
                                            <p><?php echo  html_entity_decode($commnets->comment); ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="col-lg-12">
                                <div class="col-lg-2 col-lg-offset-10">
                                    <h3>
                                        <a href="javascript:;" onclick="rateComment('minus',{{$commnets->id}})">-</a>
                                        <span class="count" id="comment_count">
                                            {{empty($postData['postCommentRatings'][$commnets->id]) ? 0:$postData['postCommentRatings'][$commnets->id]}}                                        
                                        </span>
                                        <img src="{{ asset('img/loading.gif') }}" alt="" style="display:none" id="comment_img">
                                        <a href="javascript:;" onclick="rateComment('plus',{{$commnets->id}})">+</a>                                
                                    </h3>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr />
                        </div>

                    <?php       } 
                        }?>
                </div>
            </div>
            
        </div>
        
    </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<div class="container" style="backend-color:white">

      <div class="row">

        <!-- Post Content Column -->
        
      </div>
      <!-- /.row -->

    </div>
    
@endsection
@section('css')
    <link rel="stylesheet" media="screen" href="{{asset('bootstrap-post?v=1')}}" />
    <link rel="stylesheet" media="screen" href="{{asset('css/chosen.min.css?v=1')}}" />
@endsection

@section('scripts')
 <script> 
      function hideModal(){
        jQuery('#myModal').modal('hide');
    }
    $(document).ready(function(){
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('#crf_token').val() }
        });

        $("#myModal").on("show.bs.modal", function(e) {
            url =  $(e.relatedTarget).data('target-url');
            $.get( url , function( data ) {
                $(".modal-body").html(data);
            });

        });
    });

    function ratePost(operator){
        var rate = 1;
        $('#post_count').hide();
        $('#post_img').show();
        var ratings = $('#post_count').text()*1;
        if(operator == 'minus'){
            rate = -1;
            
        }
        var post = $('#post_id').val();
        $.ajax({
            url: "{{url('admin/Post/ratepost')}}",
            type: "post",
            data: {post:post,rate:rate},
            success: function(res){
                $('#post_img').hide();
                $('#post_count').show();
                if(res != 'false'){
                    $('#post_count').text(res);
                }
            }
        });
    }


    function rateComment(operator,comment){
        var rate = 1;
        
        $('#comment_count').hide();
        $('#comment_img').show();
        var ratings = $('#comment_count').text()*1;
        if(operator == 'minus'){
            rate = -1;
        }
        $.ajax({
            url: "{{url('admin/Post/ratecomment')}}",
            type: "post",
            data: {comment:comment,rate:rate},
            success: function(res){
                $('#comment_img').hide();
                $('#comment_count').show();
                if(res != 'false'){
                    $('#comment_count').text(res);
                }
            }
        });
    }
</script>
@endsection
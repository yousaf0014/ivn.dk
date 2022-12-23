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
            
            <h4 class="pull-left">          
                <h1 class="mt-4">{{$postData['post']->title}}</h1>
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/Offer')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <div class="clearfix"></div>                    
        
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div style="padding:20px;">
                    <input type="hidden" id="post_id" value="{{$postData['post']->id}}">
                    <?php if($postData['post']->image_path){?>
                    <img class="img-fluid rounded" src="{{ asset('uploads/Ad/' . $postData['post']->image_path) }}" alt="">
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
</script>
@endsection
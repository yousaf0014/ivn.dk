 <?php if($flag){?>
 <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="pull-left">Comment</h4>
        <a href="javascript:;" onclick="jQuery('#myModal').modal('hide');" class="glyphicon glyphicon-remove-circle pull-right text-primary f20"></a>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        {!! Form::open(array('url' => 'admin/Post/Comment/'.$post->id.'/'.$comment,'id'=>'add_comment','name'=>'add_comment','files'=>'true','class'=>'form-horizontal')) !!}
            <div class="form-group">
                <label class="col-md-2  control-label" for="profilePic">Comment Pic</label>
                <div class="col-md-10">
                    <?php $path =  !empty($commentData)? asset('uploads/Comment/' . $commentData->image_path) :'';?>
                    <div id="profile-pic">
                        <img width="75" alt="No Image" src="{{$path}}">
                    </div>
                    <input type="file" name="image_path" id="profilePic" accept='image/*'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Comment:</label>
                <div class="col-lg-10">
                    {!! Form::textarea('comment', !empty($commentData->comment)? $commentData->comment:'', array('id'=>'editor','class' => 'form-control input-sm btn-toolbar','style'=>'display:none;')) !!}
                    <textarea id="text_content" class="form-control input-sm btn-toolbar"></textarea>
                </div>
            </div>
            <div class="form-group">                                
                <div class="col-lg-offset-3">
                    <button type="button" onclick="submitMe()" class="btn btn-warning btn-sm">Save</button> 
                </div>
            </div>

        {!! Form::close() !!}        
    </div>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" media="screen" href="{{asset('css/editor.css?v=1')}}" />
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/editor.js')}}"></script>

 <script type="text/javascript">
    function submitMe(){
        $('#editor').text($('#text_content').Editor("getText"));  
        $('#add_comment').submit();
    }
    $(document).ready(function(){
        $('#text_content').Editor();
        $('#text_content').Editor('setText',[$('#editor').text()]);
        options = {
                rules: {
                    "comment": "required"
                },
                messages: {
                    "comment": "Please enter Comment"
                }
            };
            
            $('#add_comment').validate( options );
    });
    //Profile Pic JS
        function handleProfileSelect(evt) {
            $('#profile-pic img').remove();
            
            var files = evt.target.files;

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

              // Only process image files.
              if (!f.type.match('image.*')) {
                continue;
              }

              var reader = new FileReader();

              // Closure to capture the file information.
              reader.onload = (function(theFile) {
                return function(e) {
                  // Render thumbnail.
                  var span = document.createElement('div');
                  span.className = '';
                  span.innerHTML = 
                  [
                    '<img style="width:75px;height:auto;" src="', 
                    e.target.result,
                    '" title="', escape(theFile.name), 
                    '"/>'
                  ].join('');
                  
                  document.getElementById('profile-pic').insertBefore(span, null);
                };
              })(f);

              // Read in the image file as a data URL.
              reader.readAsDataURL(f);
            }
          }

          document.getElementById('profilePic').addEventListener('change', handleProfileSelect, false);
          //END profile pic JS

          
          //Cover Pic JS
          function handleCoverSelect(evt) {
              $('#cover-pic img').remove();
                
            var files = evt.target.files;

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

              // Only process image files.
              if (!f.type.match('image.*')) {
                continue;
              }

              var reader = new FileReader();

              // Closure to capture the file information.
              reader.onload = (function(theFile) {
                return function(e) {
                  // Render thumbnail.
                  var span = document.createElement('div');
                  span.className = '';
                  span.innerHTML = 
                  [
                    '<img style="width:100px;height:auto;" src="', 
                    e.target.result,
                    '" title="', escape(theFile.name), 
                    '"/>'
                  ].join('');
                  
                  document.getElementById('cover-pic').insertBefore(span, null);
                };
              })(f);

              // Read in the image file as a data URL.
              reader.readAsDataURL(f);
            }
          }

       
</script>
<?php }else{?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="pull-left">Not Allowd</h4>
        <a href="javascript:;" onclick="jQuery('#myModal').modal('hide');" class="glyphicon glyphicon-remove-circle pull-right text-primary f20"></a>
        <div class="clearfix"></div>
    </div>
 </div>
<?php }?>
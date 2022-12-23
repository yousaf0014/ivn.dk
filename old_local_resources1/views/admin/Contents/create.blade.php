@extends('layouts.admin.app')
<!-- if there are creation errors, they will show here -->
@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Add Content
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/Contents')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()" class="btn btn-warning pull-right btn-sm mt5 mr10" style="margin-right:5px;">Save</a>    
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('admin/Contents')}}">Content</a></li>
                <li class="active">Add</a>
            </ol>
            {{ Html::ul($errors->all()) }}
            {!! Form::open(array('url' => 'admin/Contents','id'=>'add_content','name'=>'add_content','files'=>'true','class'=>'form-horizontal')) !!}
                @include('admin.Contents.formhtml');
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="{{asset('css/editor.css?v=1')}}" />
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/editor.js')}}"></script>
    <script type="text/javascript">
    function submitMe(){
        $('#editor').text($('#text_content').Editor("getText"));  
        $('#add_content').submit();
    }
    $(document).ready(function(){
        $('#text_content').Editor();
        $('#text_content').Editor('setText',[$('#editor').text()]);
        options = {
                rules: {
                    "title": "required"
                },
                messages: {
                    "title": "Please enter title"
                }
            };
            
            $('#add_content').validate( options );
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
@endsection
@extends('layouts.admin.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Add Content
            </h4>
            <a class="pull-right btn btn-warning btn-sm mt5" href="{{url('admin/ContentImages',$content->id)}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()" class="btn btn-warning pull-right btn-sm mt5 mr10">Save</a>    
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('admin/Contents')}}">Contents</a></li>
                <li><a href="{{url('admin/ContentImages',$content->id)}}">Content Images</a></li>
                <li class="active">Add Images</a>
            </ol>
            {{ Html::ul($errors->all()) }}
            <div class="container">
                <div class="dropzone" id="dropzoneFileUpload"></div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" media="screen" href="{{asset('css/dropzone.min.css')}}" />
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        var token = $('#crf_token').val();

        Dropzone.autoDiscover = false;
         var myDropzone = new Dropzone("div#dropzoneFileUpload", { 
             url: "{{url('admin/ContentImages/uploadFiles',$content->id)}}",
             params: {
                _token: token
              }
         });
         Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
              
            },
          };
     </script>
@endsection
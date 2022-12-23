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
                <li><a href="{{url('/Contents')}}">Contents</a></li>
                <li class="active">Add</a>
            </ol>
            {{ Html::ul($errors->all()) }}
            {!! Form::model($content, array('url' => array('admin/Contents/update', $content->id),'id'=>'add_content','name'=>'add_content','class'=>'form-horizontal', 'method' => 'PUT')) !!}
                @include('admin.Contents.formhtml');
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="{{asset('css/editor.css?v=1')}}" />
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.form.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/editor.js')}}"></script>
    <script type="text/javascript">
    function submitMe(){
        $('#editor').text($('#text_content').Editor("getText"));  
        $('#editor1').text($('#text_content1').Editor("getText"));  
        $('#add_content').submit();
    }
    $(document).ready(function(){
        $('#text_content').Editor();
        $('#text_content').Editor('setText',[$('#editor').text()]);

        $('#text_content1').Editor();
        $('#text_content1').Editor('setText',[$('#editor1').text()]);
        
        options = {
                rules: {
                    "title": "required",
                    "link_title": "required"
                },
                messages: {
                    "title": "Please enter Content Page title",
                    "link_title": "Please enter Content Link title"
                }
            };
            
            $('#add_content').validate( options );
    });
    </script>
@endsection
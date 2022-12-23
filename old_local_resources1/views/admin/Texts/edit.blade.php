@extends('layouts.admin.app')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Add Text
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/Texts')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()" class="btn btn-warning pull-right btn-sm mt5 mr10" style="margin-right:5px;">Save</a>    
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('admin/Texts')}}">Text</a></li>
                <li class="active">Add</a>
            </ol>
            {{ Html::ul($errors->all()) }}
            {!! Form::model($text, array('url' => array('admin/Texts/update', $text->id),'id'=>'add_content','name'=>'add_content','class'=>'form-horizontal', 'method' => 'PUT')) !!}
                <div class="form-group">
                    <label class="col-lg-2 control-label">Content:</label>
                    <div class="col-lg-10">
                        {!! Form::textarea('details', Input::old('details'), array('id'=>'editor','class' => 'form-control input-sm btn-toolbar','style'=>'display:none;')) !!}
                        <textarea id="text_content" class="form-control input-sm btn-toolbar"></textarea>
                    </div>
                </div>          
                <div class="form-group">                
                    <div class="col-lg-offset-1 col-lg-1">
                        <a class="pull-right btn btn-danger" href="{{url('/Text')}}">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                    </div>
                    <div class="col-lg-offset-1">
                        <button type="button" onclick="submitMe()" class="btn btn-primary btn-sm">Save</button>                                    
                    </div>
                </div>
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
    });
    </script>
@endsection
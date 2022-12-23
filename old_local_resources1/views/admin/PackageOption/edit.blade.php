@extends('layouts.admin.app')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Edit Package Option
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/PackageOptions')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()" class="btn btn-warning pull-right btn-sm mt5 mr10" style="margin-right:5px;">Save</a>    
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('admin/Package')}}">Package Option</a></li>
                <li class="active">Edit</a>
            </ol>
            {{ Html::ul($errors->all()) }}
            {!! Form::model($packageOption, array('url' => array('admin/PackageOptions/update', $packageOption->id),'id'=>'add_content','files'=>'true','name'=>'add_content','class'=>'form-horizontal', 'method' => 'PUT')) !!}
                @include('admin.PackageOption.formhtml');
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
    <script type="text/javascript">
    function submitMe(){
        $('#add_content').submit();
    }
    $(document).ready(function(){
        $('#text_content').Editor('setText',[$('#editor').text()]);
        options = {
                 rules: {
                    "text": "required",
                    "basic":"required",
                    "silver":"required",
                    "gold":"required"
                },
                messages: {
                    "text": "Please enter title",
                    "basic":"Please Select",
                    "silver":"Please Select",
                    "gold":"Please Select"
                }
            };
            
            $('#add_content').validate( options );
    });
    
        
    </script>
@endsection
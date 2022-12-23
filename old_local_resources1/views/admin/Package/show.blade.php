@extends('layouts.admin.app')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                View Package
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/Package')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('admin/Package')}}">Package</a></li>
                <li class="active">Show</a>
            </ol>
            <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
                <tr>
                    <td colspan="2"><img height="200" alt="No Image" src="{{asset('uploads/package/'.$package->image_path)}}"></td>
                </tr>
                <tr>        
                    <th class="text-center col-lg-2">Field Name</th>
                    <th class="text-center col-lg-10">Field Value</th>
                </tr>
                <tr>
                    <td class="text-center"><strong>Title</strong></td>
                    <td class="text-left">{{$package->title}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Price</strong></td>
                    <td class="text-left">{{$package->pric}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Content</strong></td>
                    <td class="text-left"><?php echo html_entity_decode($package->details)?></td>
                </tr>
            </table>    
            <div class="clearfix"></div>
            <div class="form-group">                
                <div class="col-lg-offset-1 col-lg-1">
                    <a class="pull-right btn btn-danger" href="{{url('admin/Package')}}">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                </div>                
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
  
@endsection
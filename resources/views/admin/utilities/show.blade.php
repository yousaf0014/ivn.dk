@extends('layouts.admin.app')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                View Contact Us
            </h4>
            <a class="pull-right btn btn-danger btn-sm mt5" href="{{url('admin/Contactus')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('admin/Contactus')}}">Contact Us</a></li>
                <li class="active">Show</a>
            </ol>
            <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
                <tr>        
                    <th class="text-center col-lg-2">Field Name</th>
                    <th class="text-center col-lg-10">Field Value</th>
                </tr>
                <tr>
                    <td class="text-center"><strong>First Name</strong></td>
                    <td class="text-left">{{$contact->first_name}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Last Name</strong></td>
                    <td class="text-left">{{$contact->last_name}}</td>
                </tr>                
                <tr>
                    <td class="text-center"><strong>Email</strong></td>
                    <td class="text-left">{{$contact->email}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Content</strong></td>
                    <td class="text-left"><?php echo html_entity_decode($contact->details)?></td>
                </tr>
            </table>    
            <div class="clearfix"></div>
            <div class="form-group">                
                <div class="col-lg-offset-1 col-lg-1">
                    <a class="pull-right btn btn-danger" href="{{url('admin/Contactus')}}">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                </div>                
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
  
@endsection
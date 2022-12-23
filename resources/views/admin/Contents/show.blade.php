@extends('layouts.admin.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                View Content
            </h4>
            <a class="pull-right btn btn-warning btn-sm mt5" href="{{url('admin/Contents')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('/Contents')}}">Contents</a></li>
                <li class="active">Show</a>
            </ol>
            <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
                <tr>        
                    <th class="text-center col-lg-2">Field Name</th>
                    <th class="text-center col-lg-10">Field Value</th>
                </tr>
                <tr>
                    <td class="text-center"><strong>Title For Link</strong></td>
                    <td class="text-left">{{$content->link_title}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Page Title</strong></td>
                    <td class="text-left">{{$content->title}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Meta Title Content</strong></td>
                    <td class="text-left">{{$content->meta_title_content}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Page Keywords</strong></td>
                    <td class="text-left">{{$content->page_keywords}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Page Description</strong></td>
                    <td class="text-left">{{$content->page_description}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Businee Name</strong></td>
                    <td class="text-left">{{$parantName}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Show on Homepage</strong></td>
                    <td class="text-left"> <?php echo empty($content->show_on_homepage) ? 'No':'Yes'; ?> </td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Show On Top</strong></td>
                    <td class="text-left"> <?php echo empty($content->show_on_top) ? 'No':'Yes'; ?> </td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Show On Bottom</strong></td>
                    <td class="text-left"> <?php echo empty($content->show_on_bottom) ? 'No':'Yes'; ?> </td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Footer Links</strong></td>
                    <td class="text-left"> <?php echo empty($content->show_in_footer) ? 'No':'Yes'; ?> </td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Short Description</strong></td>
                    <td class="text-left">{{$content->short_description}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Content</strong></td>
                    <td class="text-left"><?php echo html_entity_decode($content->content)?></td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Extra Content</strong></td>
                    <td class="text-left"><?php echo html_entity_decode($content->extra_content)?></td>
                </tr>
            </table>    
            <div class="clearfix"></div>
            <div class="form-group">                
                <div class="col-lg-offset-1 col-lg-1">
                    <a class="pull-right btn btn-danger" href="{{url('/Contents')}}">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                </div>                
            </div>
        </div>
    </div>
@endsection
@section('scripts')
  
@endsection
@extends('layouts.admin.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-12">
                <div class="pull-left"><h3>Users</h3></div>
                <div class="pull-right" style="padding-top:20px;color:black">
                <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('admin/userReport/')}}">
                    <select name="user_subscription" class="form-control input-sm pull-left" style="width:150px;margin-right:5px;">
                        <option value="" @if(empty($level)) {{ 'selected="selected"' }} @endif>All</option>
                        <option value="level1" @if($level == 'level1') {{ 'selected="selected"' }} @endif>Basic</option>
                        <option value="level2" @if($level == 'level2') {{ 'selected="selected"' }} @endif>Pro</option>
                        <option value="level3" @if($level == 'level3') {{ 'selected="selected"' }} @endif>Primum</option>
                    </select>
                    <select name="active" class="form-control input-sm pull-left" style="width:150px;margin-right:5px;">
                        <option value="-1" @if($active == -1) {{ 'selected="selected"' }} @endif>All</option>
                        <option value="0" @if($active == 0) {{ 'selected="selected"' }} @endif>Deleted</option>
                        <option value="1" @if($active == 1) {{ 'selected="selected"' }} @endif>Active</option>
                    </select>
                    <a href="javascript:{}" class="btn btn-warning btn-sm" onclick="$('#searchCompanies').submit();">Search</a>                    
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
        <tr>        
             <th class="text-center" width="5%">#</th>
            <th class="text-center" >Name</th>
            <th class="text-center" >Email</th>
            <th class="text-center">Subscription</th>            
        </tr>
        
        <?php 
        $counter = 0;
        ?>
        @foreach ($users as $cnt)
            <?php $counter++ ?>
            <tr >
                    <td class="text-center">{{$counter}}</td>
                    <td>{{$cnt->first_name.' '.$cnt->last_name}}</td>
                    <td>{{$cnt->email}}</td>
                    <td><?php if($cnt->user_subscription == 'level3'){
                        echo 'Primum';
                    }else if($cnt->user_subscription == 'level2'){
                        echo 'Pro';
                    }else{
                        echo 'Basic';
                    }
                    ?></td>
                </tr>
        @endforeach
    </table>    
</div>

@endsection
@section('scripts')

<script>
</script>

@endsection
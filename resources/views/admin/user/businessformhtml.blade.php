<div class="form-group">
    <label class="col-md-2" for="fName">Name</label>
    <div class="col-md-5">
        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}">
        <p class="help-block">First Name</p>
    </div>
    <div class="col-md-5">
        <input type="text" name="last_name" id="lName" class="form-control" value="{{ $user->last_name }}">
        <p class="help-block">Last Name</p>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2" for="username">Email</label>
    <div class="col-md-10">
        <input type="text" name="email" disabled="true" id="email" class="form-control" value="{{ $user->email }}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2" for="country">Country</label>
    <div class="col-md-10">
        <select name="country" class="form-control" id="country">
            <option value="">--Select Country--</option>
            <?php 
            foreach ($countries as $value){ ?>
                <option value="{{$value->id}}" <?php echo $value->id == $user->country ? 'selected="selected"':'';?>>{{$value->name}}</option>
            <?php }?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2" for="city">City</label>
    <div class="col-md-10">
        <input type="text" name="city" id="city" class="form-control" value="{{ $user->city }}">
    </div>
</div>
<div class="form-group">
    <label class="col-md-2" for="postCode">Zip Code</label>
    <div class="col-md-10">
        <input type="text" name="zipCode" id="zipCode" class="form-control" value="{{ $user->zipcode }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-2" for="profilePic">Page Pic</label>
    <div class="col-md-10">
        <div id="profile-pic">
            <img width="75" alt="No Image" src="{{ asset('uploads/user/' . $user->profile_image) }}">
        </div>
        <input type="file" name="profile_image" id="profilePic" accept='image/*'>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2" for="profilePic">Page Header</label>
    <div class="col-md-10">
        <div id="header-pic">
            <img width="75" alt="No Image" src="{{ asset('uploads/business/' . $user->header_image) }}">
        </div>
        <input type="file" name="header_image" id="headerPic" accept='image/*'>
    </div>
</div>  

<div class="form-group">
    <label class="col-md-2" for="phone1">Contact Numbers</label>
    <div class="col-md-5">
        <input type="text" name="mobile" id="phone1" class="form-control" value="{{ $user->mobile }}">
        <p class="help-block">Phone</p>
    </div>
    <div class="col-md-5">
        <input type="text" name="phone" id="phone2" class="form-control" value="{{ $user->phone }}">
        <p class="help-block">Additional Phone</p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2" for="status">Status</label>
    <div class="col-md-10">
        <label for="status1" class="checkbox-inline">
            <input type="radio" name="active" @if($user->active == 1) {{ 'checked="checked"' }} @endif id="status1" value="1" class="">
            Active
        </label>
        <label for="status0" class="checkbox-inline">
            <input type="radio" name="active" @if($user->active == 0) {{ 'checked="checked"' }} @endif id="status0" value="0" class="">
            Inactive
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-md-2" for="postCode">Password</label>
    <div class="col-md-10">
        <input type="text" name="password" id="password" class="form-control" value="">
    </div>
</div>

<div class="form-group">
    <label class="col-md-2" for="business_page_title">Business Page Title</label>
    <div class="col-md-10">
        <input type="text" name="business_page_title" id="business_page_title" class="form-control" value="{{$user->business_page_title}}">
    </div>
</div>


<div class="form-group">
    <label class="col-md-2" for="description">Description</label>
    <div class="col-md-10">        
        <textarea name="description" id="editor" style="display:none" class="form-control input-sm btn-toolbar">{{ $user->description }}</textarea>
        <textarea id="text_content" class="form-control input-sm btn-toolbar"></textarea>
    </div>
</div>


<div class="form-group">
    <label class="col-lg-2 control-label">Company name:</label>
    <div class="col-lg-10">                         
        <input type="text" name="c_name" value="<?php echo !empty($company) ? $company->name:'';?>" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Company Type:</label>
    <div class="col-lg-10">                         
        <select name="c_type" id="" class="form-control">
            <option value=""></option>
            <option value="I/S" <?php echo !empty($company) && $company->type == 'I/S' ? 'selected="selected"':'';?>>I/S</option>
            <option value="IVS" <?php echo !empty($company) && $company->type == 'IVS' ? 'selected="selected"':'';?>>IVS</option>
            <option value="ApS" <?php echo !empty($company) && $company->type == 'ApS' ? 'selected="selected"':'';?>>ApS</option>
            <option value="A/S" <?php echo !empty($company) && $company->type == 'A/S' ? 'selected="selected"':'';?>>A/S</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Company CVR:</label>
    <div class="col-lg-10">                         
        <input type="text" name="c_cvr" value="<?php echo  !empty($company)  ? $company->cvr:'';?>" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Adresse 1:</label>
    <div class="col-lg-4">                         
        <input type="text" name="c_address" value="<?php echo  !empty($company)  ? $company->address1:'';?>" class="form-control">
    </div>
    <label class="col-lg-2 control-label">Hus nr.</label>
    <div class="col-lg-4">                         
        <input type="text" name="c_house_no" value="<?php echo  !empty($company)  ? $company->house_no:'';?>" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Company Adresse 2:</label>
    <div class="col-lg-10">                         
        <input type="text" name="c_adress2" value="<?php echo  !empty($company)  ? $company->address2:'';?>" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Post nr.</label>
    <div class="col-lg-4">                         
        <input type="text" name="c_zip" value="<?php echo  !empty($company) ? $company->zip:'';?>" class="form-control">
    </div>
    <label class="col-lg-2 control-label">By:</label>
    <div class="col-lg-4">
        <input type="text" name="c_city" value="<?php echo  !empty($company) ? $company->city:'';?>" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">E-mail:</label>
    <div class="col-lg-10">                         
        <input type="email" name="c_email" value="<?php echo  !empty($company) ? $company->email:'';?>" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">WWW:</label>
    <div class="col-lg-10">                         
        <input type="text" name="c_url" value="<?php echo  !empty($company) ? $company->url:'';?>" class="form-control">
    </div>
</div>                  
<div class="form-group">
    <label class="col-lg-2 control-label">Tilknytning:</label>
    <div class="col-lg-10">                         
        <select name="c_Entrepreneurial_status" id="" class="form-control">
            <option value=""></option>
            <option value="entrepreneur" <?php echo !empty($company) && $company->entrepreneurial_status == 'entrepreneur' ? 'selected="selected"':'';?>>Jeg er iværksætter</option>
            <option value="entrepreneur_soon" <?php echo !empty($company) && $company->entrepreneurial_status == 'entrepreneur_soon' ? 'selected="selected"':'';?>>Jeg bliver snart iværksætter</option>
            <option value="interested_entrepreneurship" <?php echo !empty($company) && $company->entrepreneurial_status == 'interested_entrepreneurship' ? 'selected="selected"':'';?>>Jeg er interesseret i iværksætteri</option>
        </select>
    </div>
</div>                  
<div class="form-group">
    <label class="col-lg-2 control-label">Ugentligt timetal:</label>
    <div class="col-lg-5">                         
        <input type="radio" name="c_job_type" id="Fuldtid" <?php echo  !empty($company) && $company->job_type == 'full_time'? 'checked="checked"':'';?>  value="full_time" class="radio-button" />&nbsp;Fuldtid
    </div>
    <div class="col-lg-5">                         
        <input type="radio" name="c_job_type" id="Deltid" <?php echo  !empty($company) && $company->job_type == 'part_time'? 'checked="checked"':'';?> value="part_time" class="radio-button" />&nbsp;Deltid
    </div>
</div>

<div class="form-group">
    <label class="col-md-2" for="jobTitle">Business Page Title</label>
    <div class="col-md-10">
        <input type="text" name="business_page_title" id="jobTitle" class="form-control" value="{{ $user->business_page_title }}">
    </div>
</div>



<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        <button class="btn btn-primary pull-left" type="button" onclick="submitMe();">Submit</button>
    </div>
</div>

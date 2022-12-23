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
    <label class="col-md-2" for="user_type">User Type</label>
    <div class="col-md-10">
        <label for="admin" class="checkbox-inline">
            <input type="radio" name="user_type" @if($user->user_type == 'admin') {{ 'checked="checked"' }} @endif id="admin" value="admin" class="">
            Admin
        </label>
        <label for="user" class="checkbox-inline">
            <input type="radio" name="user_type" @if($user->user_type == 'user') {{ 'checked="checked"' }} @endif id="user" value="user" class="">
            Individual
        </label>
        
    </div>
</div>

<div class="form-group">
    <label class="col-md-2" for="description">Description</label>
    <div class="col-md-10">
        <textarea name="description" id="description" class="form-control">{{ $user->description }}</textarea>
    </div>
</div>


<div class="form-group">
    <label class="col-md-2" for="jobTitle">Job Title</label>
    <div class="col-md-10">
        <input type="text" name="job_title" id="jobTitle" class="form-control" value="{{ $user->job_title }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-2" for="profilePic">Profile Pic</label>
    <div class="col-md-10">
        <div id="profile-pic">
            <img width="75" alt="No Image" src="{{ asset('uploads/profile/' . $user->profile_image) }}">
        </div>
        <input type="file" name="profile_image" id="profilePic" accept='image/*'>
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

<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        <button class="btn btn-primary pull-left" type="submit">Submit</button>
    </div>
</div>
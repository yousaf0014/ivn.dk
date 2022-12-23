<?php
    if(!empty($title) && $title == 'business'){

    } else if(!empty($title) && $title == 'home'){ ?>
    <div class="home-top-area" style="background-image:url({{asset('images/home-banner.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="overlay-area">
                        <div class="home-slides">
                            <div class="single-home-slide">
                                <!-- if user logged in  laptop -->
                                <?php if(Auth::user()){ ?>
                                <h3 class="title">Seneste nyt fra IVN:</h3>
                                <div class="news-lists">
                                    <?php foreach($news as $nw){ ?>
                                        <div class="single-slide-news">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{ asset('uploads/Post/thumb_' . $nw->image_path) }}" alt="img">
                                                </a>
                                            </div>
                                            <div class="desc">
                                                <div class="link">
                                                    <a href="{{url('/postDetails',$nw->id)}}">{{$nw->title}}</a>
                                                </div>
                                                <div class="details">
                                                    {{shortString($nw->details,50)}}
                                                </div>
                                                <div class="readmore"><a href="{{url('/postDetails',$nw->id)}}">Læs mere</a></div>
                                            </div>
                                        </div>
                                    <?php } ?>                                    
                                </div>                                
                                <!-- if user logged in end  -->
                                <?php }else{?>

                                <!-- if user not logged in  -->
                                 <div class="visitors-box">
                                    <h3 class="mobo-hidden">&nbsp;</h3>
                                    <div class="lft" style="color:white;">
                                        <?php echo cmskey('non_logedin_slide_message');?>                                        
                                    </div>

                                    <div class="rgt">
                                        <div class="links desktop" style="padding-bottom:20px;">
                                            <a href="{{url('signup')}}" class="btn btn-primary">Opret profil</a>                                            
                                        </div>
                                        <div class="already-member" style="display:none;" style="padding-bottom:20px;">
                                            <p>Allerede medlem?</p>
                                            <div class="links">
                                                <a href="{{url('signup')}}" class="btn btn-primary">Opret profil</a>
                                            </div>
                                        </div>
                                        <div class="img">
                                            <div class="payements_menthods_div">
                                                <img src="{{asset('images/mastercard.png')}}">
                                                <img src="{{asset('images/dk.png')}}">
                                                <img src="{{asset('images/visacard.png')}}">                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- if user not logged in end -->

                                <?php } ?>
                            </div>
                            
                            <div class="single-home-slide">
                                <h3 class="title">Andre netværk:</h3>
                                <div class="slide-networks">
                                    <div class="box">
                                        <?php 
                                        foreach($networks as $network){ ?>
                                        <div class="single-network-cat-full">
                                            <a href="{{url('network/'.$network->url)}}"><img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img"></a>
                                            <p>{{$network->title}}</p>
                                            <?php if(Auth::user()){?>
                                                <a onclick="subscibeToNetwork('{{$network->id}}')" href="javascript:;" class="tp-right-link" id="network_{{$network->id}}_sub">
                                                    <div class="text-user-not-subscribed">Bliv medlem</div>
                                                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
                                                    <div class="text-user-subscribing" style="display:none;"><span>+</span>Bliv medlem</div>

                                                </a>

                                                <a href="javascript:;" style="display:none" class="tp-right-link" onclick="makeUnscribe('{{$network->id}}');" id="network_{{$network->id}}_unsub">
                                                    <div class="text-user-subscribed">Medlem</div>
                                                    <!--  User is subscribed, but has mouseover and is ready to subscribe. -->
                                                    <div class="text-user-un-subscribing" style="display:none;"><span>-</span>Forlad</div>
                                                </a>
                                            <?php } ?>                                            
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php if(!empty($business)){ ?>                
                                <div class="single-home-slide">
                                    <h3 class="title">IVN tilbyder: </h3>
                                    <div class="slide-ad-post">

                                        <h4 class="mobo-hidden">{{$business->business_page_title}}</h4>
                                        <div class="lft">
                                            <?php if(!empty($business->header_image)){?>
                                            <div class="image text-center">
                                                <a href="{{url('showbusiness',$business->id)}}">
                                                    <img src="{{asset('uploads/business/'.$business->header_image)}}" alt="ad-post-image.jpg" class="img-responsive">
                                                </a>
                                            </div>
                                            <?php } ?>                                            
                                        </div>
                                        <div class="rgt">
                                            <h4 class="mobo-show" style="display:none;">{{$business->business_page_title}}</h4>
                                            <div class="desc">
                                                {{shortString($business->description,150)}}                                              
                                            </div>
                                            <div class="link">
                                                <?php if(Auth::user()){ ?>
                                                    <a href="{{url('showbusiness',$business->id)}}" class="btn btn-primary"><?php echo cmskey('business_unit_button_text'); ?></a>
                                                <?php }else{?>
                                                    <a href="{{url('login')}}" class="btn btn-primary"><?php echo cmskey('login'); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php  } else if(!empty($title) && $title == 'User Profile'){?>
    <?php $imgPath = !empty($contentData) ? $contentData->image_path:'home-banner.jpg'; ?>
    <script type="text/javascript">
        function submitDeleteProfile(){
            var flag = confirm('<?php echo cmskey("confirm_profile_deletion"); ?>'); 
            if(flag){
                document.getElementById('delete-form').submit();
            }
                                     
        }
    </script>
    <div class="profile-view-area" style="background-image:url({{asset('user_images/'.$imgPath)}});">
        <div class="container">
            <div class="row">
                <div class="profile-view-container public">
                    <div class="col-md-12">
                        <div class="profile-image">
                            <div class="box">
                                <img src="{{asset('uploads/profile/'.$user->profile_image)}}" alt="img">                                
                            </div>
                        </div>
                        <div class="profile-information">
                            <div class="col-xs-12 col-sm-6">
                                <div class="user-title">
                                    {{$user->first_name.' '.$user->last_name}}
                                </div>
                                <div class="user-address">
                                    {{$user->address}} <span class="block">{{$user->housenumber.' '.$user->area}}</span>
                                </div>
                                <div class="user-email">
                                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                </div>
                                <?php if($user->id == Auth::user()->id){
                                        if($mobile){
                                     ?>
                                    <div class="user-email">
                                        <a href="{{url('/editProfile')}}">Ret informationer</a>
                                    </div>
                                    <div class="user-email">
                                        <a href="{{url('/getUserPayemnts')}}">{{cmskey('listPayments')}}</a>
                                    </div>
                                    
                                <?php }else{ ?>
                                    <div class="edit-information">
                                        <a href="{{url('/editProfile')}}">Ret informationer</a>
                                    </div>
                                    <div class="edit-information">
                                        <a href="{{url('/getUserPayemnts')}}">{{cmskey('listPayments')}}</a>
                                    </div>
                                
                                <?php }
                                } ?>


                                
                                <form id="delete-form" 
                                        action="{{url('/deleteProfile')}}" 
                                    method="POST" 
                                    style="display: none;">
                                                {{ csrf_field() }}
                                </form>


                                <?php if($user->id == Auth::user()->id){
                                        if($mobile){
                                     ?>
                                <div class="user-email">
                                    <a onclick="event.preventDefault(); submitDeleteProfile(); " href="{{url('/deleteProfile')}}"><?php echo cmskey('delete_user_text');?></a>
                                </div>
                                <?php }else{ ?>
                                    <div class="edit-information">
                                        <a  onclick="event.preventDefault(); submitDeleteProfile();" href="{{url('/deleteProfile')}}"><?php echo cmskey('delete_user_text');?></a>
                                    </div>
                                    <?php }
                                    } 

                                ?>

                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="subscription-title">
                                    {{!empty($companyInfo->name) ? $companyInfo->name:''}}
                                </div>
                                <div class="subscription-details">
                                   {{!empty($companyInfo->address1) ? $companyInfo->address1:''}} <span class="block">{{!empty($companyInfo->house_no) ? $companyInfo->house_no:''}} {{!empty($companyInfo->city) ? $companyInfo->city:''}}</span>
                                </div>
                                <div class="subscription-link">
                                    <a href="{{!empty($companyInfo->url) ? $companyInfo->url:''}}">{{!empty($companyInfo->url) ? $companyInfo->url:''}}</a>
                                </div>
                                <div class="user-email">
                                    <a href="mailto:{{!empty($companyInfo->email) ? $companyInfo->email:''}}">{{!empty($companyInfo->email) ? $companyInfo->email:''}}</a>
                                </div>
                                <?php if($user->id == Auth::user()->id){ ?>
                                    <div class="edit-subscription">
                                        <a href="{{url('subscription')}}">Ret abonnement</a>
                                    </div>
                                    <?php if($mobile){ ?>
                                        <div class="user-email">
                                            <a href="{{url('/sendProfileInfo')}}">{{cmskey('sendProfileInfo')}}</a>
                                        </div>
                                    <?php }else{?>
                                        <div class="edit-information">
                                            <a href="{{url('/sendProfileInfo')}}">{{cmskey('sendProfileInfo')}}</a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php  }
/*
else if(!empty($title) && $title == 'Subscription'){ ?>
    
    <?php if(!empty($contentData->image_path)){ ?>
        <div class="Subscriptions_new_top content-header" style="background-image:url({{asset('user_images/'.$contentData->image_path)}});">
    <?php }else{ ?>
        <div class="Subscriptions_new_top content-header" style="background-image:url({{asset('images/banner-my-subscription.jpg')}});">
    <?php } ?>
        <div class="container full-height pos-relative">
            <div class="row full-height">
                <div class="overlay-box min-height d-flex">
                    <div class="col-md-12">
                        <h1 class="pg-title"><?php echo $contentData->image_title; ?></h1>
                        <div class="pg-desc m-b-30"><?php echo $contentData->image_title; ?></div>
                        <div class="pg-desc"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php /*




        <div class="container">
            <div class="col-md-12 gray-block subscription-1">
                <h2 class="text-center"><?php echo cmskey('subscription_header_title',false);?></h2>
                <p class="text-center p-info">
                    <?php echo cmskey('subscription_header_details',false);?>
                </p>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 pkg-info">
                        <div class="subscription-pkg">
                            <h3><?php echo cmskey('package1_name',false);?></h3>
                            <p>
                                <?php echo cmskey('package1_text');?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 pkg-info">
                        <div class="subscription-pkg">
                            <h3><?php echo cmskey('package2_name',false);?></h3>
                            <p>
                                <?php echo cmskey('package2_text');?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 pkg-info">
                        <div class="subscription-pkg">
                            <h3><?php echo cmskey('package3_name',false);?></h3>
                            <p>
                                <?php echo cmskey('package3_text');?>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4 gray-block mobile visible-xs">
                        <div class="subscription-pkg">
                            <h3><?php echo $contentData->title; ?></h3>
                            <p>
                                <?php echo html_entity_decode($contentData->content); ?> 
                            </p>
                            <div class="btn-block">
                                <a href="#" class="btn btn-primary">Opret profil</a>
                            </div>
                            <div class="fancy-checkbox style-white">
                                <input type="checkbox" class="checkbox" id="checkbox-1">
                                <label for="checkbox-1" class="checkbox-click-target sm"><span class="checkbox-box"></span>
                                    Ja, jeg accepterer brugerbetingelserne og at modtage nyhedsbreve fra IVN.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php  */ /*

 }else{
?>
    @if (!empty($contentData->image_path))  

    <div class="category-landing-top" style="background-image:url({{asset('user_images/'.$contentData->image_path)}});">
        <div class="blue-bg overlay" style="background-image:url({{asset('user_images/'.$contentData->image_path)}});">
            <div class="container full-height">
                <div class="row full-height">
                    <div class="col-md-12 full-height">
                        <!-- <h1 class="cat-title">{{$contentData->image_title}}</h1>
                        <div class="pg-desc">{{$contentData->image_details}}</div>    -->                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        
    @endif
<?php } */ ?>
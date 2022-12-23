<style type="text/css">
    div.rgt div.desc a{
        color: white;
        text-decoration: underline;        
    }
    div.rgt div.desc a:hover{
        color: #399EE5;
        text-decoration: underline;        
    }
</style>
<?php
    if(!empty($title) && $title == 'business'){

    } else if(!empty($title) && $title == 'home'){ ?>
        <?php if(Auth::user()){?>
            <div class="home-top-area" style="background-image:url({{asset('images/home-banner.jpg')}});">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overlay-area">
                                <div class="home-slides">
                                    <div class="single-home-slide">
                                        <!-- if user logged in  laptop -->
                                        <?php if(Auth::user()){ ?>
                                                <?php $userLevelflag = false;//!empty(Auth::user()->id) && Auth::user()->user_subscription == 'level1' ? false:true; ?>
                                                <?php if($userLevelflag){ ?>                
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
                                                                        <?php echo shortString($nw->details,50); ?>
                                                                    </div>
                                                                    <div class="readmore"><a href="{{url('/postDetails',$nw->id)}}">Læs mere</a></div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>                                    
                                                    </div>                                

                                                <?php }else if(!$userLevelflag){ ?>

                                                        <div class="single-home-slide" style="margin:auto;width:100%">
                                                        <h3 class="title">Velkommen til IVN: </h3>
                                                        <div class="slide-ad-post" style="text-align:center !important;">

                                                            <h4 class="mobo-hidden">{{cmskey('free_user_home_page_heading')}}</h4>
                                                            <div class="rgt">
                                                                <div class="desc">
                                                                    <?php echo cmskey('free_user_home_page_text');?>
                                                                </div>
                                                                <div class="link" style="display:none">
                                                                    <a href="{{url('subscription')}}" class="btn btn-primary">Opgrader nu</a>                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                            
                                                <?php } ?>


                                        <!-- if user logged in end  -->
                                        <?php }else{?>

                                        <div class="visitors-box">
                                            <h3 class="mobo-hidden">&nbsp;</h3>
                                            <div class="lft" style="color:white;">
                                                <?php echo cmskey('non_logedin_slide_message1');?>                                        
                                            </div>

                                            <div class="rgt">
                                                <div class="links desktop" style="padding-bottom:20px;">
                                                    <a href="{{url('fordele')}}" class="btn btn-primary">Se medlemsfordele</a>                                            
                                                </div>
                                                <div class="already-member" style="display:none;" style="padding-bottom:20px;">
                                                    <div class="links">
                                                        <a href="{{url('fordele')}}" class="btn btn-primary">Se medlemsfordele</a>
                                                    </div>
                                                </div>                                        
                                            </div>
                                        </div>

                                        <!-- if user not logged in  -->
                                        <div class="visitors-box">
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
                                            </div>
                                        </div>
                                        <!-- if user not logged in end -->

                                        <?php } ?>
                                    </div>
                                    
                                    <div class="single-home-slide">
                                        <h3 class="title">Interesserer du dig for:</h3>
                                        <div class="slide-networks">
                                            <div class="box">
                                                <?php 
                                                foreach($networks as $network){ ?>
                                                <div class="single-network-cat-full" style="">
                                                    <a href="{{url('network/'.$network->url)}}"><img src="{{asset('uploads/network/thumb_'.$network->image_path)}}" alt="img"></a>
                                                    <p><a href="{{url('network/'.$network->url)}}">{{$network->title}}</a></p>
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
                                    <div class="single-home-slide">
                                        <h3 class="title">Medlemsfordele: </h3>
                                        <div class="slide-ad-post">
                                            <?php if(!empty($business)){?>
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
                                                        <?php echo shortString($business->description,200); ?>
                                                    </div>
                                                    <div class="link">
                                                        <?php if(Auth::user()){ ?>
                                                            <a href="{{url('showbusiness',$business->id)}}" class="btn btn-primary"><?php echo cmskey('business_unit_button_text'); ?></a>
                                                        <?php }else{?>
                                                            <a href="{{url('login')}}" class="btn btn-primary"><?php echo cmskey('login'); ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>                            
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
        <script>
                $(document).ready(function() {
                    $("#owl-carousel").owlCarousel({
                        margin:10,
                        dots: false,
                        nav: true,
                        autoplay:true,
                        responsive:{
                            0:{
                                items:1,
                                nav:true
                            },
                            600:{
                                items:2,
                                nav:false
                            },
                            1000:{
                                items:3,
                                nav:true,
                                loop:false
                            }
                        }
                    });
             
                });

            </script>
            <div class="grand-parent" style="background-image:url({{asset('images/home-banner.jpg')}});">
                <div class="layer-opacity">
                    <div id="owl-carousel" class="owl-carousel">
                        <!-- 1st carousel slider -->
                        <div class="carousel-item">
                            <div class="carousel-container1">
                                <h2><?php echo cmskey('non_logedin_first_col_heading');?></h2>
                                <div class="content">
                                    <p><?php echo cmskey('non_logedin_first_col_message');?></p>
                                </div>
                                <ul class="carousel-logo">
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-1.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-2.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-3.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-4.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-5.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-6.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-7.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-8.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-9.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-10.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-11.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-12.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-13.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-14.png')}}" alt="logo"></li>
                                    <li class="logo-item"><img src="{{asset('images/logo/logo-15.png')}}" alt="logo"></li>
                                </ul>
                            </div>
                        </div>
                        <!-- 2nd carousel slider -->
                        <div class="carousel-item">
                            <div class="carousel-container2">
                                <h2><?php echo cmskey('non_logedin_col2_heading');?></h2>
                                <div class="content">
                                    <video width="100%" height="275" controls poster="{{asset('videos/jacobbundsgaard.png')}}">
                                        <source src="{{url('videos/jacobbundsgaard.mp4')}}" type="video/mp4">
                                        <source src="{{url('videos/jacobbundsgaard.mp4')}}" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video> 
                                </div>
                                <p><?php echo cmskey('non_logedin_col2_text');?></p>
                            </div>
                        </div>
                        <!-- 3rd carousel slider -->
                        <div class="carousel-item">
                            <div class="carousel-container3">
                                <h2><?php echo cmskey('non_logedin_col3_mainheading');?></h2>
                                <h4><?php echo cmskey('non_logedin_col3_subheading');?></h4>
                                <ul class="features">
                                    <li><img src="{{asset('images/check.png')}}" height="47"><?php echo cmskey('non_logedin_col3_text1');?></li>
                                    <li><img src="{{asset('images/check.png')}}" height="47"><?php echo cmskey('non_logedin_col3_text2');?></li>
                                    <li><img src="{{asset('images/check.png')}}" height="47"><?php echo cmskey('non_logedin_col3_text3');?></li>
                                </ul>
                                <p><?php echo cmskey('non_logedin_col3_message');?></p>
                                <div class="button">
                                    <a class="btn" href="{{url('signup')}}"><?php echo cmskey('non_logedin_col3_button_text');?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
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
                            <div><h4 class="uname">{{$user->first_name.' '.$user->last_name}}</h4></div>
                        </div>
                        <div class="profile-information">
                            <div class="col-xs-12 col-sm-6 hidden-xs elmnt-hidn">
                                <div class="user-title">
                                    {{!empty($companyInfo->name) ? $companyInfo->name:''}}
                                </div>
                                <div class="user-address">
                                    {{!empty($companyInfo->address1) ? $companyInfo->address1:''}} <span class="block">{{!empty($companyInfo->house_no) ? $companyInfo->house_no:''}} {{!empty($companyInfo->city) ? $companyInfo->city:''}}</span>
                                </div>
                                <div class="user-email">
                                    <a <a href="mailto:{{!empty($companyInfo->email) ? $companyInfo->email:''}}">{{!empty($companyInfo->email) ? $companyInfo->email:''}}</a>
                                </div>

                                <div class="edit-information">
                                    <a href="{{!empty($companyInfo->url) ? $companyInfo->url:''}}">{{!empty($companyInfo->url) ? $companyInfo->url:''}}</a>
                                </div>
                                <div class="edit-information">
                                    <a style="color:white;text-decoration: underline;" onclick="trackNavigate('EditProfile','{{url('/editProfile')}}')" href="javascript:;">Ret informationer</a>                                
                                </div>
                                


                            </div>
                            <div class="col-xs-12 col-sm-6 text-center elmnt-full">
                                <div class="subscription-title">
                                    Abonnement
                                </div>
                                <div class="subscription-details text-uppercase text-center">
                                    <?php if($user->user_subscription == 'level2'){
                                        echo getPlanTitle('silver');
                                    }else if($user->user_subscription == 'level3'){
                                        echo getPlanTitle('gold');
                                    }else{
                                        echo getPlanTitle('basic');
                                    }?>
                                </div>
                                <div class="user-address">
                                    Oprettet <?php echo  date('M/d Y',strtotime($user->created_at))?>
                                </div>

                                <?php if($user->id == Auth::user()->id){
                                     ?>

                                <div class="visible-xs text-center elmnt-shwng" style="display:block !important">
                                    <div class="user-address">
                                        <div class="edit_profile_link">
                                            <a  style="color:white;text-decoration: underline;" onclick="trackNavigate('EditProfile','{{url('/editProfile')}}')" href="javascript:;">Ret informationer</a>
                                            <br/>
                                        </div>
                                        <a style="color:white;text-decoration: underline;" onclick="trackNavigate('Subscription','{{url("subscription")}}')" href="javascript:;">Skift abonnement</a><br>
                                        <a style="color:white;text-decoration: underline;" onclick="trackNavigate('Profile','{{url('/sendProfileInfo')}}')" href="javascript:;">{{cmskey('sendProfileInfo')}}</a><br>
                                        <a style="color:white;text-decoration: underline;" onclick="trackNavigate('ListPayments','{{url('/getUserPayemnts')}}')" href="javascript:;">{{cmskey('listPayments')}}</a><br>
                                        <a style="color:white;text-decoration: underline;" onclick="event.preventDefault(); sendbuttonTrack1('Tilmeldinger','tilmelding','DeleteProfile');submitDeleteProfile(); " href="{{url('/deleteProfile')}}"><?php echo cmskey('delete_user_text');?></a>
                                        <form id="delete-form" 
                                                action="{{url('/deleteProfile')}}" 
                                            method="POST" 
                                            style="display: none;">
                                                        {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
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
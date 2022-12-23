<?php  $company = getUserCompany(); ?>
<?php  $userImage = !empty(Auth::user()) && !empty(Auth::user()->profile_image) ?  Auth::user()->profile_image:'111500-profile-pic5.jpg'; ?>
<header class="site_header header-search-top">
        <div class="mob-searchbar" style="display:none;">
            <div class="tp-search">
                <form action="{{url('search')}}" method="get">
                    <?php $searchKeyword = ( ($title == 'search') && !empty($keyword) ) ? urldecode($keyword):'';  ?>
                    <input type="text" name="keyword" placeholder="Søg på IVN" value="<?php echo  $searchKeyword ?>" class="form-control search-box">
                    <input type="submit" name="Søg" value="">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row">                
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 h-lft">
                    <div class="logo" class="col-sm-3">
                        <a href="/" title="IVN">
                            <img src="{!! asset('images/logo.jpg') !!}" alt="IVN Logo">
                        </a>
                    </div>
                    <div id="mobNavButton" style="display:none;" class="col-sm-3">
                        <img src="{!! asset('images/icons/ic-mobile-menu.png') !!}"  >
                    </div>
                    <?php if (!Auth::check() && $title == 'home')  { ?>
                        <div class="hidden-md-up col-sm-6 text-center" style="valign:center;padding:10px 10px; 10px 0px;width:75%;">
                            <div class="img">
                                <div class="payements_menthods_div">
                                    <img style="padding-left:5px;" src="{{asset('images/mastercard.png')}}">
                                    <img style="padding-left:5px;" src="{{asset('images/dankort.png')}}">
                                    <img src="{{asset('images/visa.png')}}">                                                 
                                </div>
                            </div>
                        </div>
                    <?php } ?>                    
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-7 h-cntr">
                    <div class="tp-search">
                        <form action="{{url('search')}}" method="get">
                            <input type="text" name="keyword" value="<?php echo  $searchKeyword ?>" placeholder="Søg på IVN" class="form-control">
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 h-rgt">
                    <!-- if user is logged in -->
                     <?php if (!Auth::check() && $title == 'home') { ?>
                        <div style="valign:center"  class="hidden-sm-down col-sm-9 text-center">
                            <div class="img">
                                <div class="payements_menthods_div">
                                    <img style="padding-left:5px;" src="{{asset('images/mastercard.png')}}">
                                    <img style="padding-left:5px;" src="{{asset('images/dankort.png')}}">
                                    <img src="{{asset('images/visa.png')}}">                                                 
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="user-loggedin-tp">
                        <?php if (Auth::check()) { ?>
                        <div class="user-details">
                            <div class="user-name"><a href="{{ url('myProfile') }}">{{ Auth::user()->first_name.' '.Auth::user()->last_name}}</a></div>
                            <div class="business-name"><a href="{{ url('myProfile') }}">{{!empty($company) ? $company->name:''}}</a></div>
                        </div>
                        <div class="user-photo">
                            <a href="{{ url('myProfile') }}"><img src="{{asset('uploads/profile/'.Auth::user()->profile_image)}}" alt="img"></a>
                        </div>
                        <?php } ?>
                        <div class="user-link-img">
                            <img src="{{asset('images/icons/ic-user-menu-balck.png')}}" alt="ic" class="btnDesktopMenu">
                            <img src="{{asset('images/icons/ic-mobile-menu.png')}}" style="display:none" alt="ic" class="btnMobileMenu">
                        </div>
                        <?php if (Auth::check()) { ?>
                            <div class="mb-usr-details" style="display:none;">
                                <div class="user-photo">
                                    <li><a href="{{ url('myProfile') }}" title="Min profil">
                                    <img src="{{asset('uploads/profile/'.Auth::user()->profile_image)}}" alt="img"></a>
                                </div>
                                <div class="user-details">
                                    <div class="user-name"><a href="{{ url('myProfile') }}">{{ Auth::user()->first_name.' '.Auth::user()->last_name}}</a></div>
                                    <div class="business-name"><a href="{{ url('myProfile') }}">{{!empty($company) ? $company->name:''}}</a></div>
                                </div>
                            </div>
                            <div class="tp-user-links animated">
                                <ul>
                                    <li><a href="{{ url('pages/om_ivn') }}" title="Om IVN">Om IVN</a></li>
                                    <li><a href="{{ url('/fordele') }}" title="Medlemsfordele">Medlemsfordele</a></li>
                                    <li><a href="{{ url('pages/Betingelser') }}" title="Betingelser">Betingelser</a></li>
                                    <li><a href="{{ url('contact us')}}" title="Kontakt os">Kontakt os</a></li>
                                    <li class="divider"><img src="{{asset('images/dividers/divider1.png')}}" alt="divider"></li>
                                    <li><a href="{{ url('myProfile') }}" title="Min profil">Min profil</a></li>
                                    <li>
                                        <a title="Log ud" href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                 document.getElementById('logout-form1').submit();">
                                                <i class="fa fa-sign-out"></i> Log ud

                                            </a>
                                            <form id="logout-form1" 
                                                    action="{{ url('/logout') }}" 
                                                method="POST" 
                                                style="display: none;">
                                                            {{ csrf_field() }}
                                            </form>
                                    </li>
                                </ul>
                            </div>
                        <?php }else{ ?>
                            <div class="tp-user-links animated">
                                <ul>
                                    <li><a href="{{ url('/login') }}" title="Log ind">Log ind</a></li>
                                    <li><a href="{{ url('/fordele') }}" title="Medlemsfordele">Medlemsfordele</a></li>
                                    <li><a href="{{ url('contact us')}}" title="Kontakt os">Kontakt os</a></li>
                                    <li><a href="{{ url('/signup') }}" title="Opret bruger">Opret bruger</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
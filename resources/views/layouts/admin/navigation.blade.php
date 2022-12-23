<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <?php if (Auth::check()) { ?>
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->first_name.' '.Auth::user()->last_name}}</strong>
                                    </span> <span class="text-muted text-xs block"><a href="{{url('admin/')}}"> Profile</a><b class="caret"></b></span>

                        </span>
                    </a>
                    
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">Logout</a></li>
                    </ul>
                    
                </div>
                
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ isActiveRoute('Contents') }}">
                <a href="{{ url('admin/Contents') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Contents</span></a>
            </li>
            
            <li class="{{ isActiveRoute('User') }}">
                <a href="{{ url('admin/users') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Users</span></a>
            </li>
            <li class="{{ isActiveRoute('Category') }}">
                <a href="{{ url('admin/Category') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Category</span> </a>
            </li>
            <li class="{{ isActiveRoute('Post') }}">
                <a href="{{ url('admin/Post') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Post</span> </a>
            </li>
            <li class="{{ isActiveRoute('Ad') }}">
                <!-- <a href="{{ url('admin/Ad') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Ad</span> </a> -->
            </li>
            <li class="{{ isActiveRoute('Offer') }}">
                <!-- <a href="{{ url('admin/Offer') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Offer</span> </a> -->
            </li>
            <li class="{{ isActiveRoute('Texts') }}">
                <a href="{{ url('admin/Texts') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Text</span> </a>
            </li>
            <li class="{{ isActiveRoute('business') }}">
                <a href="{{ url('admin/business') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Business</span> </a>
            </li>
            <li class="{{ isActiveRoute('Contactus') }}">
                <a href="{{ url('admin/Contactus') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Contact Us</span> </a>
            </li>
            <li class="{{ isActiveRoute('reports') }}">
                <a href="{{ url('admin/reports') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Reported Posts</span> </a>
            </li>
            <li class="{{ isActiveRoute('commentReports') }}">
                <a href="{{ url('admin/commentReports') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Reported Comments</span> </a>
            </li>
            <li class="{{ isActiveRoute('Package') }}">
                <a href="{{ url('admin/Package') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Packages</span> </a>
            </li>
            <li class="{{ isActiveRoute('Package') }}">
                <a href="{{ url('admin/PackageOptions') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Packages Options</span> </a>
            </li>
            
            <li class="{{ isActiveRoute('listDeleteUsers') }}">
                <a href="{{ url('admin/listDeleteUsers') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Delete User Requests</span> </a>
            </li>
        </ul>
        <?php } ?>
    </div>
</nav>

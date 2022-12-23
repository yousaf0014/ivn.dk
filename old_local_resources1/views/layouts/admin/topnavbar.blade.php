<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="/">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search" />
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <?php if (Auth::check()) { ?>
            <li>
                <a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Log out

                </a>
                <form id="logout-form" 
                        action="{{ url('/logout') }}" 
                    method="POST" 
                    style="display: none;">
                                {{ csrf_field() }}
                </form>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>

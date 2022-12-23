<h1 class="pull-left text-info">	
	<a href="{{ url('/home') }}">IVN</a>
</h1>
<div class="pull-right" style="margin: 20px 10px;">
   <form id="logout-form" 
            action="{{ url('/logout') }}" 
        method="POST" 
        style="display: none;">
    {{ csrf_field() }}
      </form>
</div>
<div class="clearfix"></div>
@extends('layouts.default.app')
@section('content')
<!-- Header area -->
<!-- Header area End-->

<div class="content-area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 content-lft">
				<div class="row">
					<div id="search_posts_div">
						@include('postview',['post'=>$post,'postData'=>$postData])
					</div>					
				</div>
			</div>			
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="editPostPopup" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="vm-layout">

        </div>
    </div>
</div>
@endsection
@section('scripts')
@include('postjs')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.form.js?v=1')}}"></script>
<script>

</script>
@endsection
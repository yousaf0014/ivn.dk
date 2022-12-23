@extends('layouts.default.app')
@section('content')
<style type="text/css">
	div.con-detail{
		display: none;
	}
	div .quote .quote-para{
		display: none;	
	}
</style>
<div id="main-body" class="bg-white">
	<section class="main-img" style="background-image: url('{{asset('user_images/'.$contentData->image_path)}}">
		
	</section>
	<section class="first-content py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center"><?php echo $contentData->title; ?></h2>
					<p class="text-center py-4"><?php echo html_entity_decode($contentData->content); ?></p>
				</div>
			</div>
		</div>
	</section> 


	<section class="boxes-area py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box1_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/startup.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="https://mortenresen.dk/podcast/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href=" http://mortenresen.libsyn.com/rss" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href=" https://itunes.apple.com/dk/podcast/morten-resen-startup/id1112082865?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box1_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box1_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box1_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box1_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box1_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box1_bottom_text')?>" - <b><?php echo cmskey('podconsult_box1_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->


					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box2_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup2.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://solopreneurcast.dk" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://solopreneurcast.libsyn.com/rss" target="_blank"><img width="25px;" style="margin-left:10px"  src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/solopreneurcast/id914063619?l=da&mt=2&ls=1" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box2_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box2_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box2_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box2_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box2_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box2_bottom_text')?>" - <b><?php echo cmskey('podconsult_box2_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box3_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup3.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://rasmusholmgaard.dk/podcast/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="https://pinecast.com/feed/rasmus-holmgaard---startup-podcast" target="_blank"><img width="25px;" style="margin-left:10px"  src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/rasmus-holmgaard-startup-podcast/id1232191597?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box3_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box3_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box3_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box3_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box3_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box3_bottom_text')?>" - <b><?php echo cmskey('podconsult_box3_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box4_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup4.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://www.born-global.dk/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://www.born-global.dk/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px"  src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/born-global/id1347170921?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box4_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box4_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box4_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box4_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box4_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box4_bottom_text')?>" - <b><?php echo cmskey('podconsult_box4_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box5_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup5.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="https://nochmal.dk/podcasts/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="https://nochmal.dk/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/help-marketing/id926207630?mt=2&ls=1" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box5_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box5_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box5_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box5_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box5_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box5_bottom_text')?>" - <b><?php echo cmskey('podconsult_box5_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box6_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup6.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="https://www.business.dk/podcast/succeskriteriet" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://www.spreaker.com/show/2216120/episodes/feed" target="_blank"><img width="25px;" style="margin-left:10px"  src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/succes-kriteriet/id1164472064?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box6_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box6_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box6_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box6_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box6_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box6_bottom_text')?>" - <b><?php echo cmskey('podconsult_box6_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->



					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box7_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup7.png')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="https://www.gimletmedia.com/startup" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://feeds.gimletmedia.com/hearstartup" target="_blank"><img width="25px;" style="margin-left:10px"  src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/startup-podcast/id913805339?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box7_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box7_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box7_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box7_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box7_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box7_bottom_text')?>" - <b><?php echo cmskey('podconsult_box7_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box8_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup8.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://www.eofire.com/podcast/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://entrepreneuronfire.libsyn.com/rss" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/us/podcast/entrepreneuronfire.com-inspiring/id564001633" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box8_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box8_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box8_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box8_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box8_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box8_bottom_text')?>" - <b><?php echo cmskey('podconsult_box8_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->



					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box9_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup9.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://www.chrisducker.com/podcast/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://www.chrisducker.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/youpreneur-fm-how-to-build-market-monetize-grow-successful/id590043753?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box9_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box9_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box9_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box9_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box9_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box9_bottom_text')?>" - <b><?php echo cmskey('podconsult_box9_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box10_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup10.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://millespeak.com/podcast-2/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href=" http://millespeak.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/den-digitale-nomade/id1237572292?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box10_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box10_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box10_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box10_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box10_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box10_bottom_text')?>" - <b><?php echo cmskey('podconsult_box10_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->

					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box11_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup11.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://www.chrisducker.com/podcast/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://www.chrisducker.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/youpreneur-fm-how-to-build-market-monetize-grow-successful/id590043753?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box11_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box11_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box11_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box11_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box11_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box11_bottom_text')?>" - <b><?php echo cmskey('podconsult_box11_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box12_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup12.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://millespeak.com/podcast-2/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href=" http://millespeak.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/den-digitale-nomade/id1237572292?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box12_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box12_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box12_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box12_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box12_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box12_bottom_text')?>" - <b><?php echo cmskey('podconsult_box12_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->



					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box13_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup13.jpeg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://www.chrisducker.com/podcast/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://www.chrisducker.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/youpreneur-fm-how-to-build-market-monetize-grow-successful/id590043753?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box13_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box13_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box13_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box13_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box13_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box13_bottom_text')?>" - <b><?php echo cmskey('podconsult_box13_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box14_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup14.png')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://millespeak.com/podcast-2/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href=" http://millespeak.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/den-digitale-nomade/id1237572292?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box14_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box14_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box14_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box14_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box14_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box14_bottom_text')?>" - <b><?php echo cmskey('podconsult_box14_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->

					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box15_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup15.png')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://www.chrisducker.com/podcast/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href="http://www.chrisducker.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/youpreneur-fm-how-to-build-market-monetize-grow-successful/id590043753?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box15_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box15_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box15_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box15_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box15_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box15_bottom_text')?>" - <b><?php echo cmskey('podconsult_box15_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->
					<!-- ====== First Box ====== -->
					<div class="col-md-6">
						<div class="main-box">
							<h4><?php echo cmskey('podconsult_box_heading')?>:<?php echo cmskey('podconsult_box16_heading_text')?></h4>
							<div class="div-set">
								<div class="col-xs-4">
									<div class="box-img">
										<img class="img-responsive" src="{{asset('images/business-units/podconsult/startup16.jpg')}}">
									</div>
									<div class="icons">
										<ul>
											<li><a href="http://millespeak.com/podcast-2/" target="_blank"><img width="50px;" src="{{asset('images/business-units/ivn-podconsult-www.png')}}"></a></li>
											<li><a href=" http://millespeak.com/feed/podcast/" target="_blank"><img width="25px;" style="margin-left:10px" src="{{asset('images/business-units/ivn-podconsult-rss-feed.png')}}"></a></li>
											<li><a href="https://itunes.apple.com/dk/podcast/den-digitale-nomade/id1237572292?l=da&mt=2" target="_blank"><img width="25px;" src="{{asset('images/business-units/ivn-podconsult-apple-logo.png')}}"></a></li>
										</ul>
									</div>
								</div>
								<div class="col-xs-8 ">
									<div class="para">
										<p><?php echo cmskey('podconsult_box16_text')?></p>
									</div>
									<div class="con-detail">
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading1')?>: </b> <?php echo cmskey('podconsult_box16_subheading1_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading2')?>: </b> <?php echo cmskey('podconsult_box16_subheading2_text')?></p>
										</div>
										<div class="d-inline del">
											<p><b><?php echo cmskey('podconsult_box_subheading3')?>: </b> <?php echo cmskey('podconsult_box16_subheading3_text')?></p>
											<p><b><?php echo cmskey('podconsult_box_subheading4')?>: </b> <?php echo cmskey('podconsult_box16_subheading4_text')?></p>
										</div>
									</div>
									<div class="quote">
										<div class="d-inline quote-para">
											<span>"<?php echo cmskey('podconsult_box16_bottom_text')?>" - <b><?php echo cmskey('podconsult_box16_bottom_name')?></b></span>
										</div>
										<div class="d-inline quote-img">
											<img class="img-responsive align-center" src="{{asset('images/business-units/dummy-head.png')}}">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End main-box -->
					</div> <!-- End col-md-6 -->

				</div> <!-- End col-md-12 -->
			</div> <!-- End row -->
		</div> <!-- End container -->
	</section>

	<section class="podcasts">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center mb-5"><?php echo cmskey('podconsult_middle_area_heading')?></h2>
					<div class="col-md-6">
						<p><?php echo cmskey('podconsult_middle_area_text1')?></p>
					</div>
					<div class="col-md-6">
						<p><?php echo cmskey('podconsult_middle_area_text2')?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Start section Podconsult -->

	<section class="podconsult">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="w-80 mx-auto" style="margin:auto">
						<h2 class="pl-3"><?php echo cmskey('podconsult_bottom_heading')?></h2>
						<div class="col-xs-8">
							<p><?php echo cmskey('podconsult_bottom_text')?></p>
						</div>
						<div class="col-xs-4">
							<img class="img-responsive" style="margin:auto" src="{{asset('images/business-units/podconsult.jpg')}}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- popups -->
<div class="modal fade" id="msg-stopper-for-lower-users" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="vm-layout">
            <div class="vm-layout-content">
                <div class="vm-padding">
                    <div class="modal-content no-border-radius no-shadow no-border  padding-left-25 padding-right-25">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('images/icons/img-modal-close.png')}}" alt="close">
                        </button>
                        <div class="modal-header margin-bottom-30">
                            <h4 class="modal-title">
                                <?php echo  cmskey('welcome_message_header');?>
                            </h4>
                        </div>
                        <div class="modal-body padding-bottom-70">
                            <div class="desc margin-bottom-20">
                                <p class="text-center f-s-18 line-height-30">
                                    <?php echo  cmskey('welcome_message_details');?>
                                </p>
                            </div>
                            <div class="popup-buttons text-center margin-top-70">
                                <a href="{{url('subscription')}}" style="margin-right:10px;" class="btn btn-primary btn-popup min-width-300">Opgrader nu</a>
                                <a href="javascript:;" onclick="$('#msg-stopper-for-lower-users').modal('hide');" class="btn btn-primary btn-popup min-width-300">Ikke nu</a>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div>
            </div>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('scripts')
<link href="{{asset('css/font-awesome.min.css?v=1')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/podconsult_style.css?v=1')}}" rel="stylesheet" type="text/css">

<script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.error_override.js?v=1')}}"></script>
<script  type="text/javascript">
	function changeRadio(fieldName){
		if(!$('#r_'+fieldName).is(':checked')){
			$('#r_'+fieldName).attr('checked','checked');
			$('#'+fieldName).css("background", "green");
		}else{
			$('#r_'+fieldName).removeAttr('checked');
			$('#'+fieldName).css("background", "white");
		}
	}
	$(document).ready(function(){
		$("#businessForm").validate();
		<?php if(!$canUserSubscribe){ ?>
			/*$("#msg-stopper-for-lower-users").modal({
			  backdrop:"static",
			  keyboard: false
			}); */

		<?php } ?>
	});

	function showpopup(){
		/* $('#msg-stopper-for-lower-users').modal('show'); */
	}
</script>
@endsection
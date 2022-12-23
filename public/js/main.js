$(document).ready(function() {
	new WOW().init();
});
$(function() {

	if (jQuery(".home-slides").length != '') {
		 $('div.home-slides').slick({
			dots: false,
			infinite: false,
			autoplay: false,
			autoplaySpeed: 2000,
			pauseOnHover: true,
			pauseOnFocus: true,
			slidesToShow: 8,
			slidesToScroll: 1,
			responsive: [
			  {
				 breakpoint: 1920,
				 settings: 'unslick'
			  },
			  {
				 breakpoint: 1600,
				 settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				 }
			  },
			  {
				 breakpoint: 600,
				 settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				 }
			  },
			  {
				 breakpoint: 480,
				 settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				 }
			  }
			]
		 });
	  }


	$(document).mouseup(function (e) {
		
		
		if($(".links-report-post").length != 0){
			if($(".links-report-post").hasClass("active")){
				//alert();
				$(".links-report-post").removeClass("active");
			}
		}

    });




	$("#mobNavButton").click(function(){
		$(this).toggleClass("active");
		$(".user-loggedin-tp").toggleClass("active");
	});



	$(".btnRportPost").click(function(){
		$(this).toggleClass("active");
		$(this).parent().find(".links-report-post").toggleClass("active");
	});

	$(".btnComment").click(function(){
		$(this).toggleClass("active");
		$(this).parent().find(".links-report-post").toggleClass("active");
	});

	$(".comment-shower-mobile").click(function(){
		$(this).toggleClass("active");
		$(this).parent().find(".post-comments").toggleClass("active");
	});

	/*if ($(window).width() < 768) {
		$(".bntFixedCreatePost").click(function(){
  		   window.location="create-post-mobile.html";
  	   });
	}
	else {
		$(".bntFixedCreatePost").click(function(){
     		$(this).toggleClass("active");
     		$(this).parent().find(".create-post-body").toggleClass("active");
     	});
	}*/

$(".bntFixedCreatePost").click(function(){
     		$(this).toggleClass("active");
     		$(this).parent().find(".create-post-body").toggleClass("active");
     	});








	$(".btn-ivn-post-rating-mns").click(function(){
		var tVoltes = parseInt($(this).parent().find(".totle-votes").html());
		if(tVoltes >0){
			mnsVotes = tVoltes-1;
			$(this).parent().find(".totle-votes").html(mnsVotes);
		}
	});
	$(".btn-ivn-post-rating-plus").click(function(){
		var tVoltes = parseInt($(this).parent().find(".totle-votes").html());
		if(tVoltes >0){
			mnsVotes = tVoltes+1;
			$(this).parent().find(".totle-votes").html(mnsVotes);
		}
	});







	//header script
	var site_header = 0;
	if($('header.site_header').length > 0){

	 	site_header = $('header.site_header').offset().top;
	 }

	$(window).scroll(function(){
		var scrollYpos = $(document).scrollTop();

	  if (scrollYpos >= 52 ) {
		 $('header.site_header').css("top","-52px");
	  }else{
		  $('header.site_header').css("top","0px");
	  }

	  if (scrollYpos >= 115 ) {
		 $('header.site_header').css("top","-115px");
	  }else{

	  }

	});

	var lastScrollTop = 0;
	$(window).scroll(function(event){
	   var st = $(this).scrollTop();
	   if (st > lastScrollTop){

	   } else {
		   if (st > 120 ) {
	 		 $('header.site_header').css("top","-52px");
	 	  }
	   }
	   lastScrollTop = st;
	});
});
function EditPostPopup(){
	$("#editPostPopup").modal("show");
}

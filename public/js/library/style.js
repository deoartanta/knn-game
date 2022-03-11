$(document).ready(function() {

	var h_img = $(".bg-smpmuju").innerHeight();
	$(".navbar-toggler").click(function(event) {
		$(".navbarku.nav-home").toggleClass("bg-primary");
		$(".navbar-brand.tc").toggleClass("text-primary");
		$(".nav-link").attr("style","color:#ffffff !important;");
		$(".show .nav-link").removeAttr("style","color:#ffffff !important;");
	})
	if ($(window).scrollTop()>=1) {
		$(".navbarku.nav-home").attr("style","background-color:#007bff !important;");
		$(".nav-link.nav-home").attr("style","color:#ffffff !important;");
		$(".navbar-brand.nav-home").removeClass("text-primary");
	}
	$(window).scroll(function(){
		var wScroll = $(this).scrollTop();
		$('.judul').css({         
            'transform':'translate(0px,'+ wScroll/3 +'%)'
          });
		$('.ket').css({         
            'transform':'translate(0px,'+ (5-(wScroll/25)) +'%)'
          });
		$(".scroll-animasi").css({         
            'transform':'translate(-40%,'+ (-45+wScroll/6) +'%)'
          });
		if (wScroll>=1) {
			$(".navbarku.nav-home").attr("style","background-color:#007bff !important;");
			$(".nav-link.nav-home").attr("style","color:#ffffff !important;");
			$(".navbar-brand.nav-home").removeClass("text-primary");
			$(".navbar-brand.nav-home").removeClass("tc");
		}else{
			$(".nav-link.nav-home").removeAttr("style");
			$(".navbarku.nav-home").attr("style","background-color:#0000000;");
			$(".navbar-brand.nav-home").addClass("text-primary");
			$(".navbar-brand.nav-home").addClass("text-primary");
		}
	})

	//scroll smooth
	$("a.nav-link.n").click(function(event) {
		$("a.nav-link.n").removeClass("active");
	})
	$("a.d").click(function(event) {
		$("a.d").removeClass("active");
	})
	$("a").on("click", function(event) {
		$(this).addClass("active");
		var hash = this.hash;
	    if (this.hash !== "") {
	      event.preventDefault();
	      var pass = 0;
	      if ($(hash).attr("pass") !=undefined) {
	      	pass = $(hash).attr("pass");
	      }
	      $('html, body').animate({
	        scrollTop: $(hash).offset().top-pass
	      }, 1000);
	    } 
	  });

	$( function() {
	    $( "#ttl" ).datepicker({
	      dateFormat: "yy-mm-dd"
	    });
	});

});
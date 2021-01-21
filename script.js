equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}
$(document).ready(function(e) { 

    /** This is for banner Owl Carousel **/	
    $('#home_sl').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        navText: ["<img src='img/prev-banner.jpg'>","<img src='img/next-banner.jpg'>"],
        autoplay:true,
        autoplayTimeout:4000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
	
	$(document).ready(function() {
				  var owl = $('#testi');
				  owl.owlCarousel({
					loop: true,
					margin: 0,
					 nav:true,
					navRewind: false,
					responsive: {
					  0: {
						items: 1
					  },
					  600: {
						items: 1
					  },
					  1000: {
						items: 1
					  }
					}
				  })
				})
    
    $('#tab ul li').click(function(){
		var index = $('#tab ul li').index(this);
		$(this).addClass('current').siblings().removeClass('current');
		$('#tab .tab').eq(index).addClass('current').siblings().removeClass('current');
	});
	
	$('.responsivemenu').click(function(e){
		$('ul#category').hide();
		$('ul#menu').slideToggle();
	});
	
	var width=$(window).width();
	
	if(width < 768){
	$('.showcatg').click(function(e){
		$('ul#menu').hide();
		$('ul#category').slideToggle();
	});
	}
	
	
});

$(window).load(function(e){
	equalheight('.productRow .col-3 .proThumb');
	equalheight('.latestPostapart .lprow .col-3 .proThumb');
});

$(window).resize(function(e){
	equalheight('.productRow .col-3 .proThumb');
	equalheight('.latestPostapart .lprow .col-3 .proThumb');
});

/*
     FILE ARCHIVED ON 19:11:15 Dec 07, 2016 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 10:50:44 Oct 24, 2019.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  LoadShardBlock: 239.245 (3)
  esindex: 0.013
  captures_list: 255.368
  exclusion.robots.policy: 0.192
  load_resource: 253.031
  PetaboxLoader3.datanode: 82.149 (5)
  RedisCDXSource: 0.637
  exclusion.robots: 0.206
  PetaboxLoader3.resolve: 316.768 (4)
  CDXLines.iter: 11.774 (3)
*/
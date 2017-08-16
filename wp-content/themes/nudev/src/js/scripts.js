(function( root, $, undefined ) {
	"use strict";

	$(function () {

		/*Remove the lines below once you are done testing*/
                                var wi = $(window).width();
                                $("p.testp").text('Screen width is currently: ' + wi + 'px.');

                                $(window).resize(function() {


                                                /*Remove the lines below once you are done testing*/
                                                var wi = $(window).width();

                                                if (wi <= 576){
                                                                                $("p.testp").text('Screen width is less than or equal to 576px. Width is currently: ' + wi + 'px.');
                                                                                }
                                                else if (wi <= 680){
                                                                                $("p.testp").text('Screen width is between 577px and 680px. Width is currently: ' + wi + 'px.');
                                                                                }
                                                else if (wi <= 1024){
                                                                                $("p.testp").text('Screen width is between 681px and 1024px. Width is currently: ' + wi + 'px.');
                                                                                }
                                                else if (wi <= 1500){
                                                                                $("p.testp").text('Screen width is between 1025px and 1499px. Width is currently: ' + wi + 'px.');
                                                                                }
                                                else {
                                                                                $("p.testp").text('Screen width is greater than 1500px. Width is currently: ' + wi + 'px.');
                                                                                }
                                });








		// DOM ready, take it away

		// this is the magnific listener to know when to open a gallaery lightbox
		$("ul.gallery").each(function(){
			$(this).magnificPopup({
				delegate:"a",
				gallery:{
					enabled:true
				},
				image:{
					titleSrc:function(item){
						return item.el.attr("data-title");
					}
				}
			});
		});



		if($(window).width() <= 1080){
			$("div#secondarynav ul").click(function(){
				if($(this).hasClass("open")){
					$(this).removeClass("open");
				}else{
					$(this).addClass("open");
				}
			});
		}







		// check to see if a sidenote has come into view on the screen and then fade it in
		$(window).on("scroll resize",function(){

			if($('#contentarea:not(.multimedia):not(.staticcontent)').css('position') !== "relative"){
				if($(".title img").height() < $(window).height()){
					$('#contentarea:not(.multimedia):not(.staticcontent)').css({"top":($(".title img").height() - $('header').height()) - 40,'opacity':1.0});
				}else{
					$('#contentarea:not(.multimedia):not(.staticcontent)').css({"top":($(window).height() - $('header').height()) - 40,'opacity':1.0});
				}
			}else{
				$('#contentarea:not(.multimedia):not(.staticcontent)').css({'top':0,'opacity':1.0});
			}


			// check to see if the panels section has made it to the top of the browser window
			if($('#title').length){
				if($( "#contentarea:not(.multimedia):not(.staticcontent)" ).offset().top - $( document ).scrollTop() <= 0){
					$('#title').hide();
				}else{
					$('#title').show();
				}
			}



			// remove the hover from the utility nav if page is scrolled
			$("div#secondarynav ul").removeClass("open");






			// check to see if one of the animated content blocks has come onto the screen and should now be visible
    	$(".sidenote, blockquote").each(function(index, element){
        if (isScrolledIntoView(element)){
          $(element).animate({opacity: 1.0},500);
        }
    });

		function isScrolledIntoView(elem){
			var centerY = Math.max(0,(($(window).height()-$(elem).outerHeight()) / 1) + $(window).scrollTop());
	    var elementTop = $(elem).offset().top;
	    var elementBottom = elementTop + $(elem).height();
	    return elementTop <= centerY && elementBottom >= centerY;
		}
});



	});

} ( this, jQuery ));



$(window).load(function(){

	// if we have loaded an article, fade the title area in after half a second

	$('#title').animate({opacity: 1.0},750);

	if($('#contentarea:not(.multimedia):not(.staticcontent)').css('position') !== "relative"){
		if($(".title img").height() < $(window).height()){
			$('#contentarea:not(.multimedia):not(.staticcontent)').css({"top":($(".title img").height() - $('header').height()) - 40,'opacity':1.0});
		}else{
			$('#contentarea:not(.multimedia):not(.staticcontent)').css({"top":($(window).height() - $('header').height()) - 40,'opacity':1.0});
		}
	}else{
		$('#contentarea:not(.multimedia):not(.staticcontent)').css({'top':0,'opacity':1.0});
	}
});

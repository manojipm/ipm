(function ($) {
	$("#green_check").on('click', function (e) {
		if($(this).is(':checked')){
			$('.green_auto').prop('checked', 'checked');				
		}else{
			$('.green_auto').removeAttr('checked');
			
		}	
	});
	
	$(".green_auto").on('click',function(e){
		if($(".green_auto").length == $(".green_auto:checked").length) {
			$("#green_check").prop("checked", "checked");
		}else {
			$("#green_check").removeAttr("checked");
		}
	});

	
	$(".mask_phone").length>0&&$(".mask_phone").mask("(999) 999-9999");
	
	
	
	
	
	
	$('#disbaleEntirePage').click(function(){
			$("body").prepend("<div class=\"overlay\"><img style='opacity: 1; margin: 300px auto;' alt='please wait...' src='"+siteurl+"img/ajax-loader.gif'></div>");

			$(".overlay").css({
				"position": "absolute", 
				"width": $(document).width(), 
				"height": $(document).height(),
				"z-index": 99999, 
				"background": '#2d2d2d', 
				"text-align": 'center', 
			}).fadeTo(0, 0.9);
		});

})(jQuery);


$(document).ready(function(){	
	$('#menu').slicknav();
	
	$(window).load(function(){
		$('body .slicknav_nav').removeAttr('style');
		$('body .slicknav_nav').removeClass('slicknav_hidden');
	});
	
	$(document).on('click','.slicknav_btn',function(){
		$('body').toggleClass('slicknav-active');
	});
	
	setTimeout(function(){
		$('#successFlashMsg').slideUp(1500);
	}, 3000);
	
});

$(window).load(function(){
  $('#slider').flexslider({
	animation: "slide",
	start: function(slider){
	  $('body').removeClass('loading');
	}
  });
});
	  
$(window).load(function(){
  $('#carousel').flexslider({
	animation: "slide",
	animationLoop: true,
	itemWidth: 160,
	itemMargin: 35,
	minItems: 2,
	maxItems: 4,
	start: function(slider){
	  $('body').removeClass('loading');
	}
  });
});
		
// datepicker
if($('.datepick').length > 0){
	$('.datepick').datepicker({
		 //startDate: "today"
	}).on('changeDate', function(e){
		$(this).datepicker('hide');
	});;
}

if($(".select2-me").length > 0){
	$(".select2-me").select2();
}
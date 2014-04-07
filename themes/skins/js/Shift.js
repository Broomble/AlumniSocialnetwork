$(function(){
    $('.sidebar-fa-content,.chat-container,#notifications-content ').slimScroll({
        height: '300px',
        railVisible: true,
        alwaysVisible: true,
        color: '#000',
    });


    var lm = $("#sidr");
		    lm.css({
		    	'width':'0'
		    });
	var lmTrigger = $("#simple-menu");
	var countM = 0 ,countE = 0;

/*What hapens when the menu button is clicked*/	
	  
lmTrigger.click( function(){

	var bdcont = $('.row-body').outerWidth();
	var bdlw = ($(window).width()-bdcont)/2;
		
		countM +=1;
		if(countM%2==0){

			lm.animate({
				'width':'0',
			},100);
			$('body').animate({
				'margin-left':'0',
			},100);
			$('.row-body').animate({
				'margin-left': 'auto',
			},100);
			
		} else {
			lm.animate({
				'width':'57',
			},100);
			$('body').animate({
				'margin-left':'57',
			},100);
			$('.row-body').animate({
				'margin-left': bdlw,
			},100);
			countE = 0;

		}	
	});

	var expander = $('.expander');
/*What hapens when the expander button is clicked*/

	expander.click(function(){
 		countE +=1;
	 	if(countE%2==0){

	 		$('#sidr').animate({
	 			'width':'57'
	 		});
	 		expander.css({
	 		'background':' url(../themes/Shifted/images/expander.png)',
	 		'background-position': '7px 5px',
	 		'background-repeat':'no-repeat'
	 		});
	 	
	 	} else {
	 		
	 		$('#sidr').animate({
	 			'width':'190'
	 		});
	 		expander.css({
	 		'background':' url("../themes/Shifted/images/retracter.png")',
	 		'background-position': '-28px 5px',
	 		'background-repeat':'no-repeat'
	 		});
	 	}
	});
$(window).resize(function(){
			$('.row-body').css({
				'margin-left': 'auto',
			});
			$('body').css({
				'margin-left':'0',
			},100);
	}
			);

/*var popmenu = $();
 popmenu.hide().appendTo(".menu");*/



	$(".menu").hover(function(){
		$(this).prepend("<div class='biguparrow'>uparrow</div>").css("height","270px").css("width", "26%");
		$(this).append("<div class='popup_menu'><ul><li class='acount-settings' ><a href='{$url}/index.php?a=settings'> <strong>{$lng->user_ttl_general}</strong></a></li><li class='pictures'><a href='{$url}/index.php?a=settings&b=avatar'> <strong>{$lng->user_ttl_avatar}</strong></a></li><li class='notifications-settings'><a href='{$url}/index.php?a=settings&b=notifications'> <strong>{$lng->user_ttl_notifications}</strong></a></li><li class='passord-settings'><a href='{$url}/index.php?a=settings&b=security'> <strong>{$lng->user_ttl_security}</strong></a></li></ul></div>");


		},function(){

			$(".popup_menu").remove();
			$(".biguparrow").remove();
			$(".menu").css("height","45px").css("width","auto");
		});


	
	var typeList = $(".widget-types .sidebar-header,.widget-archive .sidebar-header");
		typeList.append("<div class='hider' style='float:right;'>+</div>").css({
			'background':'#fff','border-left': '3px solid #3ac162'	});
		typeList.next().siblings(".sidebar-link").hide();




	var typeSubscription = $(".widget-subscriptions .sidebar-header,.widget-subscribers .sidebar-header");
		typeSubscription.append("<div class='hider' style='float:right;'>+</div>").css("background","#f5f5f5");
		typeSubscription.siblings(".sidebar-subscriptions").hide();



	$(".hider").click(function(){
		if ($(this).text()=="+") {
				$(this).text("-").parents().next().siblings(".sidebar-link").slideDown(200);
				var subscriptions = $(this).parents().siblings(".sidebar-subscriptions");
				$(this).text("-");
				subscriptions.slideDown(200);

				

				subscriptions.hover(function(){
					$this = $(this);
					 var username = $this.children('.sidebar-title-container').text();
									$this.prepend('<div class="custom-tooltip">'+username+'</div>');		
											},
								function(){
											$('.custom-tooltip').remove();
											} 
								);
		} else {
			$(this).text("+").parents().next().siblings(".sidebar-link").slideUp(200);
			$(this).text("+").parents().siblings(".sidebar-subscriptions").slideUp(200);
		}

	});




	 
});
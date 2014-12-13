function resize(){
	var screen_height = $('#screenSizeContainer').height();	
	var screen_width = $('#screenSizeContainer').width();	
	var height = screen_height - $("body").scrollTop();

	var menu_height = screen_width * 0.06;
	var min_menu_height = screen_width * 0.03;
	
	if( height < 0 ){
		height = 0;
	}
	//alert( $("body").scrollTop() );
	
	//if( $("body").scrollTop() < screen_height + 100 ){
	
		if( height < min_menu_height ){
			height = min_menu_height;
		}

		if( height < menu_height  ){
			$('#objectMenu').height( height );
			$('#objectMenu').css({'line-height' : height + "px"  });
		}else{
			$('#objectMenu').height( menu_height );
			$('#objectMenu').css({'line-height' : menu_height + "px"  });
		}
		
		$('#objectMenu div.avatarBackground').height( ( $('#objectMenu div.avatarBox').height() - menu_height ) / 2 );

		$('#objectMenu img.avatar').height( height * ( screen_width / 10 ) / screen_height + ( min_menu_height - 20 ) );
		$('#objectMenu img.avatar').width( $('#objectMenu img.avatar').height() );

		$('#objectMenu').css( {'bottom' :  ( ( height - min_menu_height ) * 0.2 ) +"px"  });
		$('#objectBackgroundFoto').height( height );

		$('#objectMenu div.avatarBackground').height( Math.round( ( $('#objectMenu div.avatarBox').height() - menu_height ) / 2 ) );
		$('#objectMenu div.avatarBackground').width( $('#objectMenu img.avatar').width() + 20 );

		$('#objectMenu div.top').css( {'top' : -$('#objectMenu div.top').height() } );
		$('#objectMenu div.bottom').css( {'bottom' : -$('#objectMenu div.top').height() } );

		$('#objectMenu div.avatarBox').css( { "margin-top" : -( ( ( $('#objectMenu img.avatar').height() + 20 ) / 2 ) - ( $('#objectMenu').height() / 2 ) ) } );
		$('#objectMenu div.avatarBox').css( { "margin-left" : ( ( height * 5 ) / screen_height + 1 ) + "%" } );
		$('#objectMenu div.avatarBackground').css( { "margin-left" : ( ( height * 5 ) / screen_height + 1 ) + "%" } );
		//$('#objectMenu div.avatarBox').css( { "margin-top" : - $('#objectMenu div.avatarBackground').height() } );

	//}

}

$(document).ready(function() {
	$('html').css({ "font-size" : ( 2 * ( parseInt( $("body").width() ) * 0.005 ) ) + "px" } );
	
	$(window).resize(function() {
		$('html').css({ "font-size" : ( 2 * ( parseInt( $("body").width() ) * 0.005 ) ) + "px" } );
		resize();
	});
	
	resize();
	
	$(window).scroll(function() {
		resize();
	});
	
	$('a.entity_menu_position').click( function( event ){
		$(event.target).attr('href');
		
		$.get( $(event.target).attr('href') + '?no_entity_template=1', function( o ){
			$('#objectContent').html( o );
			window.history.pushState(
				{ page: 'messages' },
				'Messages',
				$(event.target).attr('href')
			);
			$('html, body').animate({
				scrollTop: ( $("#objectContent").offset().top - ( 3 * parseInt( $('html').css('font-size') ) ) )
			}, 200);
			
		});
		
		event.stopPropagation();
		return false;
	});
	
	/*	
	window.onpopstate = function(event) {
		$.get( document.location + '?no_entity_template=1', function( o ){
			$('#objectContent').html( o );
			$('html, body').animate({
				scrollTop: ( $("#objectContent").offset().top - ( 3 * parseInt( $('html').css('font-size') ) ) )
			}, 200);
		});

		//alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
	};
	*/
});
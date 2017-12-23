$(document).ready( function() {
	var $submenu = $('.submenu');
	var $mainmenu = $('.mainmenu');
	$submenu.hide();
	$submenu.on('click','li', function() {
		$submenu.siblings().find('li').removeClass('chosen');
		$(this).addClass('chosen');
	});
	$mainmenu.on('click', 'li', function() {
		$(this).next('.submenu').slideToggle().siblings('.submenu').slideUp();
	});
	/**微信回复**/
	$('.wereplay select').change(function(){
		var value = $(this).val();
		if(value == 1) {
			$('#group1').css('display','block');$('#group2').css('display','none');$('#group3').css('display','none');$('#group4').css('display','none');$('#group5').css('display','none');$('#group6').css('display','none');
		} else if(value == 2) {
			$('#group1').css('display','none');$('#group2').css('display','block');$('#group3').css('display','none');$('#group4').css('display','none');$('#group5').css('display','none');$('#group6').css('display','none');
		} else if(value == 3) {
			$('#group1').css('display','none');$('#group2').css('display','none');$('#group3').css('display','block');$('#group4').css('display','none');$('#group5').css('display','none');$('#group6').css('display','none');
		} else if(value == 4) {
			$('#group1').css('display','none');$('#group2').css('display','none');$('#group3').css('display','none');$('#group4').css('display','block');$('#group5').css('display','none');$('#group6').css('display','none');
		} else if(value == 5) {
			$('#group1').css('display','none');$('#group2').css('display','none');$('#group3').css('display','none');$('#group4').css('display','none');$('#group5').css('display','block');$('#group6').css('display','none');
		} else {
			$('#group1').css('display','none');$('#group2').css('display','none');$('#group3').css('display','none');$('#group4').css('display','none');$('#group5').css('display','none');$('#group6').css('display','block');
		}
	});

	/**微信菜单**/
	var sel = $('#type').val();
	if(sel == 'click'){
		$('.parent-menu').show();
		$('.event').show();
		$('.url').hide();
	}else if(sel == 'view'){
		$('.parent-menu').show();
		$('.url').show();
		$('.event').hide();
	}else{
		$('.event').hide();
		$('.url').hide();
		$('.parent-menu').hide();
	}
	$('.wemenu .wemenu-type select').change(function(){
		var sel = $(this).val();
		if(sel == 'click'){
			$('.parent-menu').show();
			$('.event').show();
			$('.url').hide();
		}else if(sel == 'view'){
			$('.parent-menu').show();
			$('.url').show();
			$('.event').hide();
		}else{
			$('.event').hide();
			$('.url').hide();
			$('.parent-menu').hide();
		}
	});


});
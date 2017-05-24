//转载请保留版权信息：懒人图库 www.lanrentuku.com
$(document).ready(function(){
	$('#hb').click(function(){
		var _left = ($(window).width() - 960) / 2;
		$('#self-intro').animate({left: _left + 'px'});
		$('#self-intro').find('.close').fadeIn('fast');
		$(this).hide();
	})
	
	$('#self-intro .close').click(function(){
		$('#self-intro').animate({left:'-920px'});
		$(this).fadeOut('fast');
		$('#hb').show();
	})
})
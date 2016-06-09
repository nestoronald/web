jQuery(document).ready(function($) {
	$('#dcssb-float').css({marginLeft: '-575px'});
	$('#link-go').click(function(e){
		$('#dcsmt-form').submit();
		e.preventDefault();
	});
});
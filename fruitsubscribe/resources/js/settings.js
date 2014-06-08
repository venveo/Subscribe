$(function(){

	// Toggle Settings
	$('body').on('change', '.fruit-toggle .lightswitch', function (e) {
		var $elem = $(this);
		var $value = $elem.find('input').val();
		var $id = $elem.closest('.fruit-toggle').data('toggle');
		var $toggle = $($id);
		if($value == 1)
		{
			$toggle.removeClass('hidden');		
		}
		else
		{
			$toggle.addClass('hidden');		
		}

	});	
	
});
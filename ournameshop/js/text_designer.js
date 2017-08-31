$(function() {
	var holder 		= $('.fancybox-inner');

	var textareas 	= holder.find('.preview-text input');

	var textarea1 	= holder.find('.preview-text input:first');
	var textarea2 	= holder.find('.preview-text input:eq(1)');

	holder.find('.color').on('click', function() {
		var lnk = $(this);

		lnk.parent().find('.color').removeClass('active');
    	lnk.addClass('active');

    	textareas.css('color', lnk.data('color-code'));
	});

	holder.find('.color:first').trigger('click');

	textareas.css(
		'background-color', $('.product-preview.overlay-color').css('background-color')
	);

	holder.find('.family-slogan').on('change', function() {
		var sel 	= $(this);
		var text 	= $(this).val().split("\n");
		
		textarea1.val(text[0]);
		textarea2.val(text[1]);
	}).trigger('change');

	holder.find('.font-family').on('change', function() {
		textareas.css('font-family', $(this).find('option:selected').data('font-family'));
	}).trigger('change');

	$('.text-designer-frm').on('submit', function(e) {
		e.preventDefault();
		
		var frm 	= $(this);
		var text 	= get_text();
		
		if(!text.length)
		{
			alert('Please type something');
			holder.find('.preview-text input:first').focus();
			
			return;
		}

		frm.find('button:submit').text('please wait...').attr('disabled', true);

		var params = {
			tpl_id: 	tpl_id,
			text: 		text,
			color: 		get_text_color(),
			family: 	holder.find('.font-family').val()
		};

		$.post('/print_designer/text_preview', params, function(data) {

			if(data.success)
			{
				if($('img.tpl-thumb').length)
				{
					$('.tpl-thumb').attr('src', data.image_url);
				}
				else
				{
					$('<img src="' + data.image_url + '" class="' + $('canvas.tpl-thumb').attr('class') + '" id="tpl-thumb" />')
					.insertBefore($('canvas.tpl-thumb'));

					$('canvas.tpl-thumb').remove();
				}

				$('img.tpl-thumb').on('load', function() {
					//$(document).trigger('tpl-thumb-loaded');
					$.fancybox.close();
				});

				$('[name=custom_print_file]').val(data.filename);

				$.each(params, function(i, v) {
					if(i != 'tpl_id')
						$('.product-chooser-frm').prepend('<input type="hidden" name="text[' + i + ']" value="' + v + '" />');
				});
			}
			else
			{
				alert(data.msg);
			}
		}, 'json')
	});

	var get_text = function() {
		if(!textarea1.val() && !textarea2.val())
			return false;

		return [textarea1.val(), textarea2.val()].join("\n");
	}

	var get_text_color = function() {
		return holder.find('.color.active').data('color-code');
	}
});


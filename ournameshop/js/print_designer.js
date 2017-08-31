/*

Logo Customizer

It allows user to build final print logo on product's page

Change size/color/rotaion of logo
Add texts

Based on fabric.js library
http://fabricjs.com/


*/

var print_designer = (function() {
	var canvas;
	var settings 			= {};

	var cwidth 				= 300;
	var cheight				= 360;

	var panel 				= $('.print-designer-panel');

	var add_text_lnk 		= $('.open-text-designer');

	var canvas_holder 		= $('.product-preview .canvas-holder');

	add_text_lnk.on('click', function(e) {
		e.preventDefault();
		_addText();
	});

	$('.color-chooser .spectrum-color').spectrum({
    color: '#000',
    showButtons: false,

    move: function(color) {
	    var color = color.toHexString();
			_paintLogo(color, $(this).data('filter'));
		}
	});

	$('.embroidery-color-holder .color').on('click', function() {
		var lnk 	= $(this);
		var holder 	= lnk.parent();

		holder.find('.color').removeClass('active');
		lnk.addClass('active');

		_paintLogo(lnk.data('color-code'), 'Tint');
	});


	$(document).on('click', function(e) {
		if(
			$(e.target).parents().closest('.colorpicker').length ||
			$(e.target).parents().closest('.print-designer-panel').length ||
			$(e.target)[0].localName == 'canvas' ||
			$(e.target).hasClass('open-text-designer')
		)
			return;

		canvas.discardActiveObject();
	});

	$('[name=filter_color]').on('change', function() {
		var h = ($(this).val());
		Caman('#target', function(value) {
			this.revert();
			this.hue(h).render();
			this.render(function() {
				canvas.item(0).setSrc(document.getElementById('target').toDataURL(), function() {
					canvas.renderAll();
				});
			});
		});
	});

	$('[name=invert_color]').on('change', function() {
		var checked = ($(this).is(":checked"));
		Caman('#target', function(value) {
			this.revert();
			if(checked){
				this.invert();
			}
			this.render(function() {
				canvas.item(0).setSrc(document.getElementById('target').toDataURL(), function() {
					canvas.renderAll();
				});
			});
		});
	});

	$('[name=choose_color]').on('change', function() {
		var new_color = $(this).val();
		Caman('#target', function(value) {
			this.colorize(new_color,100).render()
			this.render(function() {
				canvas.item(0).setSrc(document.getElementById('target').toDataURL(), function() {
					canvas.renderAll();
				});
			});
		});
	});

	/* Added By Glado 2016/5/10 START */
	$('[name=adjust_color_btn]').on('change', function() {
		var checked = ($(this).is(":checked"));
		$('#adjust_color_panel').toggle();
	});

	$('[name=choose_color_btn]').on('change', function() {
		var checked = ($(this).is(":checked"));
		$('#control_panel').toggle();
		$('#choose_color_panel').toggle();
	});

	$('#return_btn').on('click', function() {
		$('#choose_color_btn').prop('checked', false);
		$('#control_panel').toggle();
		$('#choose_color_panel').toggle();
	});

	$(document).on('click', '#choose_color_panel .lcol', function(e) {
		var lnk = $(this);
	    var frm = lnk.parents().closest('form');
	    lnk.parent().find('.lcol').removeClass('active');
	    lnk.addClass('active');
	    var new_color = lnk.data('color-code');
		Caman('#target', function(value) {
			this.colorize(new_color,100).render()
			this.render(function() {
				canvas.item(0).setSrc(document.getElementById('target').toDataURL(), function() {
					canvas.renderAll();
				});
			});
		});
	});
	/* Added By Glado 2016/5/10 END */

	$('.hue-rainbow-holder').click(function(e) {
    	var offsetX = (e.pageX - $(this).offset().left);

    	$('[name=filter_color]').val(
    		Math.round(100 / 200 * (offsetX-100))
    	).trigger('change');
	});

	function _paintLogo(color, filter) {
		var obj 		= canvas.item(0);

		if(filter == 'Multiply')
			obj.filters[0] 			= new fabric.Image.filters.Multiply();
		else
			obj.filters[0] 			= new fabric.Image.filters.Tint();

		obj.filters[0].color 	= color;

  		obj.applyFilters(canvas.renderAll.bind(canvas));
	}

	function _addText() {
		var text 		= 'Family\'s that Pray Together\nStay Together';
		var fill_color 	= _get_text_fill_color();

	    var textSample = new fabric.IText(text, {
	      	fontFamily: 'Angilla-Tattoo',
	      	fill: fill_color,
	      	hasRotatingPoint: true,
	      	centerTransform: true,
	      	textAlign: 'center',

	  		fontSize: 26,
	  		centeredScaling: true,

			scaleX: settings.SCALEX,
			scaleY: settings.SCALEY,

			originX: 'center',
			originY: 'center'
	    });

	    textSample.set({
	    	top: canvas.getHeight() - textSample.getHeight() + 10
	    });
	    canvas.add(textSample);

	    textSample.centerH();

	    if($('.embroidery-obj-color-holder').length)
	    {
	    	$('.embroidery-obj-color-holder .color').removeClass('active');

	    	$('.embroidery-obj-color-holder').find(
	    		'.color[data-color-code="' + fill_color + '"]'
    		).addClass('active');
	    }

	    canvas.setActiveObject(textSample);
	    textSample.setCoords();

	    panel.find('.obj-color').val(fill_color);
	}

	function _get_text_fill_color()
	{
		if($('.embroidery-obj-color-holder').length)
		{
			var colors = $('.embroidery-obj-color-holder .color');

			var color  = $(
				colors[Math.floor(Math.random() * colors.length)]
			).data('color-code');

			return color;
		}
		else
		{
			return _getRandomColor();
		}
	}

	$(window).on('resize', function() {
		var w = $('body').width();

		_scaleCanvas(_get_scale_width());
	})

	function _scaleCanvas(width)
	{
		_resizeCanvas(_get_scale_width());
		var objects = canvas.getObjects();

		for(i in objects)
		{
			scaleToCanvas(objects[i]);
		}
	}

	function _resizeCanvas(width)
	{
		settings.SCALE_FACTOR = canvas.getWidth() / width;

		settings.SCALEX = settings.SCALEY = 1 / settings.SCALE_FACTOR;

	    canvas.setWidth(canvas.getWidth() * settings.SCALEX);
	    canvas.setHeight(canvas.getHeight() * settings.SCALEY);

	    canvas.renderAll();
	}

	function scaleToCanvas(obj)
	{
		var SCALE_FACTOR = settings.SCALE_FACTOR;

    	var scaleX = obj.scaleX;
        var scaleY = obj.scaleY;

        var left = obj.left;
        var top = obj.top;

        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
        var tempLeft = left * (1 / SCALE_FACTOR);
        var tempTop = top * (1 / SCALE_FACTOR);

        obj.scaleX = tempScaleX;
        obj.scaleY = tempScaleY;
        obj.left = tempLeft;
        obj.top = tempTop;

        obj.setCoords();

	    canvas.renderAll();
	    return obj;
	}

	// Zoom Out
	function zoomOut() {
	    // TODO limit max cavas zoom out

	    canvasScale = canvasScale / SCALE_FACTOR;

	    canvas.setHeight(canvas.getHeight() * (1 / SCALE_FACTOR));
	    canvas.setWidth(canvas.getWidth() * (1 / SCALE_FACTOR));

	    var objects = canvas.getObjects();

	    for (var i in objects) {
	        var scaleX = objects[i].scaleX;
	        var scaleY = objects[i].scaleY;
	        var left = objects[i].left;
	        var top = objects[i].top;

	        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
	        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
	        var tempLeft = left * (1 / SCALE_FACTOR);
	        var tempTop = top * (1 / SCALE_FACTOR);

	        objects[i].scaleX = tempScaleX;
	        objects[i].scaleY = tempScaleY;
	        objects[i].left = tempLeft;
	        objects[i].top = tempTop;

	        objects[i].setCoords();
	    }

	    canvas.renderAll();
	}

	function _getRandomColor() {
		var letters = '0123456789ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
		    color += letters[Math.floor(Math.random() * 16)];
		}

		return color;
	}

	function _HSVtoRGB(h, s, v)
	{
		var r, g, b, i, f, p, q, t;

	    if (h && s === undefined && v === undefined) {
	        s = h.s, v = h.v, h = h.h;
	    }

	    i = Math.floor(h * 6);
	    f = h * 6 - i;
	    p = v * (1 - s);
	    q = v * (1 - f * s);
	    t = v * (1 - (1 - f) * s);
	    switch (i % 6) {
	        case 0: r = v, g = t, b = p; break;
	        case 1: r = q, g = v, b = p; break;
	        case 2: r = p, g = v, b = t; break;
	        case 3: r = p, g = q, b = v; break;
	        case 4: r = t, g = p, b = v; break;
	        case 5: r = v, g = p, b = q; break;
	    }
	    return {
	        r: Math.floor(r * 255),
	        g: Math.floor(g * 255),
	        b: Math.floor(b * 255)
	    };
	}

	function _get_scale_width()
	{
		var w = $('body').width();

		if(w < 768)
		{
			return settings.scales[3];
		}
		else if(w > 767 && w < 991)
		{
			return settings.scales[2];
		}
		else if(w > 990 && w < 1199)
		{
			return settings.scales[1];
		}
		else
		{
			return settings.scales[0];
		}
	}

	function detectIE() {
	    var ua = window.navigator.userAgent;

	    var msie = ua.indexOf('MSIE ');
	    if (msie > 0) {
	        // IE 10 or older => return version number
	        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
	    }

	    var trident = ua.indexOf('Trident/');
	    if (trident > 0) {
	        // IE 11 => return version number
	        var rv = ua.indexOf('rv:');
	        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
	    }

	    var edge = ua.indexOf('Edge/');
	    if (edge > 0) {
	       // IE 12 => return version number
	       return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
	    }

	    // other browser
	    return false;
	}

	function colors_cnt()
	{

	}

	function applyFilters(obj, filters)
	{
		var filter, current_filter, filter_params;

		for(i in filters)
		{
			current_filter = filters[i];

			if(current_filter.type == 'Tint')
			{
				filter = new fabric.Image.filters.Tint(current_filter);
			}
			else
			{
				filter = new fabric.Image.filters.Multiply(current_filter);
			}

			obj.filters.push(filter);
		}

		obj.applyFilters(canvas.renderAll.bind(canvas));
	}

	return {
		init: function(logo_url, params) {


			settings = $.extend({
				logo_scale: 		1,
				cwidth: 			cwidth,
				cheight: 			cheight,
				scales: 			[150, 150, 150, 100],
				params: 			false
			}, params);

			canvas = $('.canvas-holder canvas')[0];

			canvas.width 	= settings.cwidth;
			canvas.height 	= settings.cheight;

			canvas 			= new fabric.Canvas('canvas-logo');
			var center 		= canvas.getCenter();

			var img_load_fired 	= false;
			var img 			= new Image();

			img.crossOrigin = 'Anonymous';
			img.src 		= logo_url;
			var imgInstance;

			img.onload = function () {
				if(img_load_fired == true)
					return;

				img_load_fired = true;

				imgInstance = new fabric.Image(img);

				imgInstance.scale(settings.logo_scale).set({
					centeredScaling: true,
					originX: 'center',
					originY: 'center'
				});

				canvas.add(imgInstance).setActiveObject(imgInstance);;
				imgInstance.center();
				imgInstance.setCoords();

				var hiddenImg = document.createElement('img');
				hiddenImg.src = canvas.getActiveObject().toDataURL();
				hiddenImg.id = 'target';
				hiddenImg.style.display = 'none';
				document.body.appendChild(hiddenImg);

				_resizeCanvas(_get_scale_width());
				scaleToCanvas(imgInstance);


				if(settings.params)
				{
					$.each(settings.params, function(i, v) {
						if(v.type == 'image')
						{
							imgInstance.setAngle(v.angle);
							imgInstance.setScaleX(v.scaleX);
							imgInstance.setScaleY(v.scaleY);

							imgInstance.setLeft(v.left);
							imgInstance.setTop(v.top);

							imgInstance.setWidth(v.width);
							imgInstance.setHeight(v.height);


							imgInstance.setFlipX(v.flipX);
							imgInstance.setFlipY(v.flipY);

							if(v.filters)
							{
								applyFilters(imgInstance, v.filters);
							}

							scaleToCanvas(imgInstance);
						}
						else
						{
						    var textSample = new fabric.IText(v.text, {
						    	hasRotatingPoint: true,
						      	centerTransform: true,

						      	fontFamily: v.fontFamily,
						      	fill: v.fill,
						      	angle: v.angle,

						      	textAlign: v.textAlign,

						  		fontSize: v.fontSize,
						  		centeredScaling: true,
								width: v.width,
								height: v.height,

								left: v.left,
								top: v.top,
								scaleX: v.scaleX,
								scaleY: v.scaleY,

								flipX: v.flipX,
								flipY: v.flipY,

								originX: 'center',
								originY: 'center'
						    });

						    canvas.add(textSample);
						    scaleToCanvas(textSample);
						}

					});
				}


				$('.canvas-holder').animate({opacity: 1}, 300);

				$(document).trigger('canval_logo_loaded');
		    };

		    panel.find('.close-panel').on('click', function() {
		    	canvas.discardActiveObject();
		    })

			canvas.on('selection:cleared', function(e) {

				close_customizer_panel(panel);


				canvas_holder.removeClass('active');
			});

			var show_customizer = true;

			canvas.on({
		  		'mouse:down': function(e) {
		  			show_customizer = true;
		  		},

			    'object:moving': function(e) {
			    	show_customizer = false;
			    },

			    'object:scaling': function(e) {
			    	show_customizer = false;
			    },

			    'object:rotating': function(e) {
			    	show_customizer = false;
			    }
			});



			canvas.on('mouse:up', function(e) {
				if(!show_customizer)
					return;


			  	var obj 		= e.target;

			  	if(typeof(obj) == 'undefined')
			  		return;

			  	var obj_types 	= {'i-text': 'Text', 'image': 'Logo'};

			  	canvas_holder.addClass('active');

			  	panel.find('.panel-title').text(obj_types[obj.type] + ' Settings');

			  	open_customizer_panel(panel);

			  	if(obj.type == 'i-text')
			  	{
			  		if(
			  			$('select.family-slogan option:contains("' + obj.text + '")').length
			  		)
			  		{
			  			$('select.family-slogan').removeClass('hidden');
			  			$('textarea.family-slogan').addClass('hidden');

			  			$('select.family-slogan option:contains("' + obj.text + '")').attr('selected', true);
			  		}
			  		else
			  		{
			  			$('select.family-slogan').addClass('hidden');
			  			$('textarea.family-slogan').removeClass('hidden').val(obj.text);
			  		}

				  	$('.family-slogan').off('change keyup').on('change keyup', function() {
				  		var text = $(this).val();

				  		if(text == 'custom')
				  		{
				  			$('.family-slogan').toggleClass('hidden');
				  			text = '';
				  		}

				  		obj.set({text: text});

				  		canvas.renderAll();
				  	})

				  	panel.find(
				  		'.font-family option[data-font-family="' + obj.fontFamily + '"]'
			  		).attr('selected', true);

				  	panel.find('.font-family').off('change').on('change', function() {
				  		if(!$(this).val())
				  			return;

						obj.set(
							{fontFamily: $(this).find('option:selected').data('font-family')}
						);

						canvas.renderAll();
					});


				  	panel.find('.btn-sm.btn-danger').off('click').on('click', function(e) {
				  		e.preventDefault();

				  		obj.remove();
				  	});

				  	panel.find('.image-params').addClass('hidden');
				  	panel.find('.text-params').removeClass('hidden');

				  	panel.find('.obj-colorpicker-trigger').css('background', obj.get('fill'));
			  	}
			  	else
			  	{
			  		panel.find('.text-params').addClass('hidden');
			  		panel.find('.image-params').removeClass('hidden');
			  	}

			  	panel.find('.embroidery-obj-color-holder .color').off('click').on('click', function() {
			  		var lnk 	= $(this);
					var holder 	= lnk.parent();

					holder.find('.color').removeClass('active');
					lnk.addClass('active');


					if(obj.type == 'i-text')
					{
						obj.set({fill: $(this).data('color-code')});

					}
					else
					{
						_paintLogo(lnk.data('color-code'), settings.filter);
					}

			  		canvas.renderAll();
			  	});

			  	var init_color;

			  	if(obj.type == 'i-text')
			  	{
			  		init_color = obj.fill;
			  	}
			  	else if(obj.filters.length > 0)
			  	{
			  		init_color = obj.filters[0].color;
			  	}

			  	panel.find('.spectrum-color').spectrum({
				    color: init_color,
				    showButtons: false,

				    move: function(color) {
					    var color = color.toHexString();

					    if(obj.type == 'i-text')
				  		{
				  			obj.set({fill: color});
				  			canvas.renderAll();
				  		}
				  		else
				  		{
				  			_paintLogo(color, settings.filter);
				  		}
						}
					});


			  	panel.find('[data-move]').off('click').on('click', function(e) {
		  			e.preventDefault();

		  			var move 		= 10;

		  			var lnk 		= $(this);
		  			var where 		= lnk.data('move');


		  			if(where == 'left' || where == 'right')
		  			{
		  				obj.set({left: obj.get('left') + (where == 'right' ? move : -(move))});
		  			}
		  			else if(where == 'up' || where == 'down')
		  			{
		  				obj.set({top: obj.get('top') + (where == 'down' ? move : -(move))});
		  			}

		  			canvas.renderAll();
		  		});

			  	panel.find('.obj-scale').off('input change').on('input change', function() {
			  		obj.scale( 1 + parseInt($(this).val()) / 10 );
			  		canvas.renderAll();
			  	});

			  	panel.find('[data-align]').off('click').on('click', function(e) {
			  		e.preventDefault();

			  		var lnk 	= $(this);
			  		var align 	= lnk.data('align');

			  		if(align == 'hcenter')
			  		{
			  			obj.centerH();
			  		}
			  		else if(align == 'vcenter')
			  		{
			  			obj.centerV();
			  		}
			  		else
			  		{
			  			obj.set({
				  			textAlign: align
				  		});
			  		}

			  		obj.setCoords();
			  		canvas.renderAll();
			  	});

			  	panel.find('[data-flip]').off('click').on('click', function(e) {
			  		e.preventDefault();
			  		var lnk 	= $(this);
			  		var flip 	= lnk.data('flip');

			  		if(flip == 'x')
			  			obj.set({flipX: !obj.getFlipX()});
			  		else if(flip == 'y')
			  			obj.set({flipY: !obj.getFlipY()});

			  		canvas.renderAll();
			  	});
			});

			$('.reset-customizer').on('click', function(e) {
		  		e.preventDefault();

		  		imgInstance.filters = [];
    			imgInstance.applyFilters(canvas.renderAll.bind(canvas));
		  	});
		},

		getCanvas: function() {
			return canvas;
		},

		jsonsify: function() {
			var json = {};

			$.each(canvas.toObject().objects, function(i, obj) {

				json[i] = {
					type: null, angle: null, flipX: null, flipY: null, left: null, top: null, scaleX: null,
					scaleY: null, height: null, width: null, fill: null, filters: null
				}

				$.each(json[i], function(key) {
					if(obj[key] === false)
					{
						delete json[i][key];
					}
					else
					{
						json[i][key] = obj[key];
					}
				});

				if(obj.type == 'i-text')
				{
					json[i].text 		= obj.text;
					json[i].fontFamily 	= obj.fontFamily;
					json[i].fontSize 	= obj.fontSize;
					json[i].textAlign 	= obj.textAlign;
				}
			});

			return json;
		},

		resizeCanvas: function(width) {
			_resizeCanvas(width);
		},

		scaleToCanvas: function(obj) {
			scaleToCanvas(obj);
		},

		resizeEntireCanvas: function(width) {
			_resizeCanvas(width);

			canvas.forEachObject(function(obj) {
				scaleToCanvas(obj);
			});
		},

		drawRainbow: function (holder) {

			for (i = 0; i <= 1; i += 0.01)
			{
			   var c 	= _HSVtoRGB(i, 1, 1);
			   var d 	= $('<div style="float:left;"></div>');

			   d.css('width', '2px');
			   d.css('height', '40px');

			   d.css('background', "rgba(" + c.r + ", " + c.b + ", " + c.g + ", 1)");
			   holder.append(d);
			}
		},

		HSVtoRGB: function (h, s, v) {
			return _HSVtoRGB(h, s, v);
		},

		detectIE: function() {
			return detectIE();
		},

		dataURLify: function() {
			return $('#canvas-logo')[0].toDataURL();
		},

		share_params: function() {
	      	var old_canvas_width  = canvas.getWidth();

	      	this.resizeEntireCanvas(300);

	      	var canvas_params = JSON.stringify(this.jsonsify());
	      	var img           = print_designer.dataURLify();

	      	this.resizeEntireCanvas(old_canvas_width);

	      	return {
	      		'canvas_params': 	canvas_params,
	      		'img': 				img
	      	}
		}
	}
})();

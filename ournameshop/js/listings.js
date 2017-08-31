var listing_canvas = function() {
	var holder 							= $('.surface-items');
	var logos;

	function Canvas(canvas) {
		this.fabric 			= canvas;
	}
	
	Canvas.prototype.inject_logo = function(params) {
		var my_fabric 		= this.fabric;
		var img 			= new Image();
		var imgInstance;

		img.crossOrigin 	= 'Anonymous';
		img.src 			= params.url + '?n=3';


		img.onload = function () {
			imgInstance = new fabric.Image(img, {
				hoverCursor: 'pointer'
			});

			imgInstance.hasControls = false;
			imgInstance.hasBorders  = false;

			my_fabric.add(imgInstance);

			scaleToCanvas.call(my_fabric, imgInstance);
			
			applyFilters.call(
				my_fabric, imgInstance, 
				params.filters
			);
		}
	}
	
	function random_string(len)
	{
		len = len || 5;
		return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, len);
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

		obj.applyFilters(this.renderAll.bind(this));
	}

	function scaleToCanvas(obj)
	{
		// var SCALE_FACTOR = settings.SCALE_FACTOR;
		var SCALE_FACTOR = 300 / 210;

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
	    
	    this.renderAll();
	    return obj;
	}

	function prepare_fabric_canvas(i, logo)
	{
		var id, replace;

		id = 'canvas-' + random_string();

		c = $('<canvas></canvas');
		
		c.prop('id', id);

		c.prop('width', 	$(logo).width());
		c.prop('height', 	$(logo).height());
			
		replace = $('<div class="tpl-thumb"></div>');
		replace.append(c);

		$(logo).replaceWith(replace);
		
		return new fabric.Canvas(id);
	}

	return {
		replace: function() {
			logos 							= holder.find('img.tpl-thumb[data-filters]');

			logos.css({
				width: 	210,
				height: 146
			});

			$.each(logos, function(i, logo) {
				canvas = prepare_fabric_canvas(i, logo);

				canvas = new Canvas(canvas);

				canvas.inject_logo({
						url: 		$(logo).prop('src'), 
						filters: 	$(logo).data('filters')
					}
				);
			});
		}
	}
};
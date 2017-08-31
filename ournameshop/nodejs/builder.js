var tmp_path 		= process.argv.slice(2)[1];
var tmp_name 		= Math.random().toString(36).substring(7);

var canvas_sizes 	= JSON.parse(process.argv.slice(2)[2]);

process.stdout.write(tmp_name);

var fs 				= require('fs'),
    fabric 			= require('fabric').fabric,
    out 			= fs.createWriteStream('/tmp/' + tmp_name),
    events 			= require('events'),
	eventEmitter 	= new events.EventEmitter();
   
var cwidth 			= canvas_sizes.cwidth;
var cheight 		= canvas_sizes.cheight;

var small_w 		= canvas_sizes.small_w;
var small_h 		= canvas_sizes.small_h;

var ratio 		= cwidth / small_w;

var canvas = fabric.createCanvasForNode(
	cwidth, cheight
);

fs.readFile('../application/config/print_designer.json', {encoding: 'utf-8'}, function (err, data) {
  
  if (err) throw err;

  data = JSON.parse(data);


  for(i in data)
  {

  	if(data[i].web_font)
  	{
  		font = new canvas.Font(data[i].family, '../fonts/prints/' + data[i].file);
  		canvas.contextContainer.addFont(font);
  	}
  }

  eventEmitter.emit('fontsReady');
});

eventEmitter.on('fontsReady', function() {
	var font_size 	= 188;
	var center 		= canvas.getCenter();
	

	json_str 		= new Buffer(process.argv.slice(2)[0], 'base64').toString('ascii');

	json_str 		= json_str.replace("\n", '\\n');

	var json = JSON.parse(json_str);

	var curr_obj;

	for (var k in json)
	{
		curr_obj = json[k];
		
		var ratio_params = ['left', 'top', 'width', 'height'];


		if(curr_obj.type == 'i-text')
		{	

			curr_obj.fontSize 	= 160;//font_size;

			

			curr_obj.width 		= curr_obj.width 	* ratio;
			curr_obj.height 	= curr_obj.height 	* ratio;

			curr_obj.left 		= curr_obj.left 	* ratio;
			curr_obj.top 		= curr_obj.top 		* ratio;

			curr_obj.originX 	= 'center';
			curr_obj.originY 	= 'center';
			

			
			
			canvas.add(
				new fabric.IText(curr_obj.text, curr_obj)
			);
		}

		else if(curr_obj.type == 'image')
		{	
			var this_curr_obj = curr_obj;

			fabric.util.loadImage(tmp_path, function(img) {				
			
				var oImg = new fabric.Image(img);

				// this_curr_obj.left 		= (this_curr_obj.left / this_curr_obj.scaleX) 	- (this_curr_obj.width / 2);
				// this_curr_obj.top 		= (this_curr_obj.top / this_curr_obj.scaleY)	- (this_curr_obj.height / 2);

				this_curr_obj.width 	= this_curr_obj.width 	* ratio;
				this_curr_obj.height 	= this_curr_obj.height 	* ratio;

				this_curr_obj.left 		= this_curr_obj.left 	* ratio;
				this_curr_obj.top 		= this_curr_obj.top 	* ratio;

				this_curr_obj.originX 	= 'center';
				this_curr_obj.originY 	= 'center';
				// this_curr_obj.scaleX 	= this_curr_obj.scaleY = 1;

				if(this_curr_obj.filters)
				{
					applyFilters(oImg, this_curr_obj.filters, this_curr_obj);
				}
				



				oImg.set(this_curr_obj);
				
				canvas.add(oImg);
			  	proceed();
			});
		}
	}
});



function applyFilters(obj, filters, this_curr_obj)
{
	var filter, current_filter, filter_params;

	for(i in filters)
	{
		current_filter = this_curr_obj.filters[i];

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

function proceed() {
    var __stream = canvas.createPNGStream();

    __stream.on('data', function(chunk) {
      out.write(chunk);
    });

    __stream.on('end', function() {
      out.end();
    });
}


return;





// var canvas 		= new fabric.Canvas('canvas-logo');



// fabric.Image.fromURL('http://fabricjs.com/assets/pug.jpg', function(img){
//   canvas.add(img.set({ left: 100, top: 100 }).scale(0.2));
//   proceed();
// });


fabric.util.loadImage('http://lastname.dev/img/smith.png', function(img) {
	
	var oImg = new fabric.Image(img);
	// console.log(oImg);

	oImg.scale(0.5).set({
	  // left: 100,
	  // top: 100,
	  flipX: true
	});

	canvas.add(oImg);
	oImg.centerH();
  	proceed();
});




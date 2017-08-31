/**
 * This class helps to use the Printful API
 * version 1.1
 * copyright 2014 Idea Bits LLC
 */

var http = require('http');
var https = require('https');
var querystring = require('querystring');

var USER_AGENT = 'Printful API Node.js Library 1.1';
var url = require('url');
//API key
var key = 'w8es6aix-g4s4-gkr9:vm5h-vxg6l96lj746';
//var key = '66t7vuyn-s19z-aoxj:j7zx-9sbj0cnueikn';
var Request = function(method, path, data, params,response_param){
	var _success, _error;

	//Additinal info about the request
	var info = {
		code: null,//Response status code
		result: null,//Response result element data
		response: null,//Full Response data
		response_raw: null,//Raw response
		total_items: null,//Total information from paging (if any)
		method: method,
		path: path,
		data: data,
		params: params
	};

	//Set up success callback
	this.success = function(callback){
		_success = callback;
		return this;
	}

	//Set up error callback
	this.error = function(callback){
		_error = callback;
		return this;
	}

	if(params){
		path = path + '?' + querystring.stringify(params);
		
	}

	//console.log("path : " , path);
	var options = {
		host: 'api.theprintful.com',
		port: 443,
		path: path,
		method: method,
		auth: key,
		headers: {
			'User-Agent': USER_AGENT,
			'Content-Type': 'application/json',
			'Access-Control-Allow-Origin' : '*',
			'Access-Control-Allow-Headers' : 'X-Requested-With',
			'Access-Control-Allow-Headers' : 'Origin, Content-Type, Accept',
			'Access-Control-Allow-Methods' : 'PUT, GET, POST'
		}
	};
	
	var req = https.request(options, function(res) {
		console.log("get Response");
		var body = '';

		res.on('data', function(chunk) {
			body += chunk;
		});
		res.on('end', function() {
			info.response_raw = body;
			try{
				var json = JSON.parse(body);
				//console.log(json);
			}
			catch(e){
				response_param.end("Invalid JSON in the Response");
				console.log(e);
				if(_error){
					_error('Invalid JSON in the response', info);
				}
				return;
			}
			info.response = json;

			if(typeof json.code == 'undefined' || typeof json.result == 'undefined'){
				response_param.end("Invalid API response");
				if(_error){
					_error('Invalid API response', info);
				}
				return;
			} else{
				info.code = json.code;
				info.result = json.result;
				if(json.code <200 || json.code >=300){
					if(_error){
						_error(info.result, info);
					}
				} else if(_success){
					if(json.paging){
						info.total_items = json.paging.total;
					}
					_success(info.result, info);
				}
			}
			response_param.end(JSON.stringify(json));
		});
	}).on('error', function(e) {
		if(_error){
			_error('HTTP request failed - '+ e.message, info);
		}
	});
	if(data){
		req.write(JSON.stringify(data));
	}
	req.end();
	return this;
}
var app = http.createServer(function ( req, res){
	var path = url.parse(req.url).pathname;
	var parameters = url.parse(req.url , true ).query;
	var method = req.method;
	res.writeHead("Access-Control-Allow-Origin", "*");
	res.writeHead("Access-Control-Allow-Headers", "X-Requested-With");
	res.writeHead("Access-Control-Allow-Headers", "Origin, Content-Type, Accept")
	res.writeHead("Access-Control-Allow-Methods", "PUT, GET,POST");
	if ( method == 'GET' ) {
		console.log(method);
		var data = parameters.data;
		var param = parameters.param;
		Request(method , path , data , param,res);
	} else {
		var body = '';
        req.on('data', function (data) {
            body += data;
            // Too much POST data, kill the connection!
            // 1e6 === 1 * Math.pow(10, 6) === 1 * 1000000 ~~~ 1MB
            if (body.length > 1e6)
                request.connection.destroy();
        });
        req.on('end', function () {
			var post = JSON.parse(body);
			console.log(post);
			try {
				JSON.parse(post);
				console.log("params : " , post);
				
			} catch (e) {
				console.log("not JSON");
			}
            Request(method , path , post , parameters.param,res);
            // use post['blah'], etc.
        });
	}	
	
}).listen(3030);

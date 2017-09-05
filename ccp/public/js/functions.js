function ConfirmSubmit(click_id){
	document.getElementById('button-confirm'+click_id).value = 	"encours...";
	var http  = new XMLHttpRequest();
	var url = "http://localhost/refer2/public/refer/confirm";
	var params = "click_id="+click_id;
	http.open('POST',url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	    	if(http.responseText == 1){
				document.getElementById('button-confirm'+click_id).value = 	"done";
	    	}else{
				document.getElementById('button-confirm'+click_id).value = 	"try again";
	    	}
	    }
	}
	http.send(params);
}

function RejectSubmit(click_id){
	document.getElementById('button-reject'+click_id).value = 	"encours...";
	var http  = new XMLHttpRequest();
	var url = "http://localhost/refer2/public/refer/reject";
	var params = "click_id="+click_id;
	http.open('POST',url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	    	if(http.responseText == 1){
				document.getElementById('button-reject'+click_id).value = 	"done";
	    	}else{
				document.getElementById('button-reject'+click_id).value = 	"try again";
	    	}
	    }
	}
	http.send(params);
}


function isValideUserName(username){
	if(username=='')
		return 0;
	return 1;
}

function MakeMoneySubmit(refer_id){
	UserNameCheck = document.getElementById(refer_id).value;
	if(!isValideUserName(UserNameCheck)){
		alert('user name not valide');
	}else{
			document.getElementById('button'+refer_id).value = "encours.."; 
			var http  = new XMLHttpRequest();
			var url = "http://localhost/refer2/public/refer/makemoney";
			var params = "UserNameCheck="+UserNameCheck+"&refer_id="+refer_id;
			http.open('POST',url, true);

			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");

			http.onreadystatechange = function() {//Call a function when the state changes.
			    if(http.readyState == 4 && http.status == 200) {
			    	if(http.responseText == 1){
			    		document.getElementById('button'+refer_id).onclick = '';
						document.getElementById('button'+refer_id).value = "done"; 
			    	}else{
						document.getElementById('button'+refer_id).value = "try again"; 
			    	}
			    }
			}
			http.send(params);
		}
}

function DeleteRefer(refer_id){
			document.getElementById('DeleteButton'+refer_id).value = "encours.."; 
			var http  = new XMLHttpRequest();
			var url = "http://localhost/refer2/public/refer/deleterefer";
			var params = "refer_id="+refer_id;
			http.open('POST',url, true);

			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");

			http.onreadystatechange = function() {//Call a function when the state changes.
			    if(http.readyState == 4 && http.status == 200) {
			    	if(http.responseText == 1){
			    		document.getElementById('DeleteButton'+refer_id).onclick = '';
						document.getElementById('DeleteButton'+refer_id).value = "done"; 
			    	}else{
						document.getElementById('DeleteButton'+refer_id).value = "try again"; 
			    	}
			    }
			}
			http.send(params);
}

function GetEditRefer(refer_id){
	site_name = document.getElementById('site_name'+refer_id).innerHTML;
	refer = document.getElementById('refer'+refer_id).innerHTML;
	click = document.getElementById('click'+refer_id).innerHTML;
	amount = document.getElementById('amount'+refer_id).innerHTML;
	document.getElementById('site_name'+refer_id).innerHTML = "<input type='text' id='site_name_input"+refer_id+"' value="+site_name+">";
	document.getElementById('refer'+refer_id).innerHTML = "<input type='text' id='refer_input"+refer_id+"' value="+refer+">";
	document.getElementById('click'+refer_id).innerHTML = "<input type='text' id='click_input"+refer_id+"' value="+click+">";
	document.getElementById('amount'+refer_id).innerHTML = "<input type='text' id='amount_input"+refer_id+"' value="+amount+">";
	document.getElementById('editbutton'+refer_id).innerHTML = "<input type='button'  value='save' id='editbuttoninput"+refer_id+"' onclick='PostEditRefer("+refer_id+" )''>";
}

function PostEditRefer(refer_id){
			document.getElementById('editbuttoninput'+refer_id).value = "encours.."; 
			var http  = new XMLHttpRequest();
			var url = "http://localhost/refer2/public/refer/editrefer";
			var  site_name = document.getElementById('site_name_input'+refer_id).value;
			var refer = document.getElementById('refer_input'+refer_id).value;
			var click = document.getElementById('click_input'+refer_id).value;
			var amount = document.getElementById('amount_input'+refer_id).value;
			var params = "refer_id="+refer_id+"&site_name="+site_name+"&refer="+refer+"&click="+click+"&amount="+amount;

			http.open('POST',url, true);

			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");
			http.onreadystatechange = function() {//Call a function when the state changes.
			    if(http.readyState == 4 && http.status == 200) {
			    	alert(http.responseText);
			    	if(http.responseText == 1){
			    		document.getElementById('editbuttoninput'+refer_id).onclick = '';
						document.getElementById('editbuttoninput'+refer_id).value = "done"; 
			    	}else{
						document.getElementById('editbuttoninput'+refer_id).value = "try again"; 
			    	}
			    }
			}
			http.send(params);
	}


function Complain(click_id){
	document.getElementById('button-complain'+click_id).value = 	"encours...";
	var http  = new XMLHttpRequest();
	var url = "http://localhost/refer2/public/refer/complain";
	var params = "click_id="+click_id;
	http.open('POST',url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	    	if(http.responseText == 1){
				document.getElementById('button-complain'+click_id).value = 	"done";
	    	}else{
				document.getElementById('button-complain'+click_id).value = 	"try again";
	    	}
	    }
	}
	http.send(params);
}

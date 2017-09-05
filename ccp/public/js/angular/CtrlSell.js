app.controller("CtrlSell",function($scope){
	$scope.infos = {
		amount : true,
		ccp_info : false,
		paypal_info : false,
		contact_info : false,
		submit : false
	};
	$scope.HideAndShow = function(h, s) {
		$scope.infos[h] = false;
		$scope.infos[s] = true;
	};
});
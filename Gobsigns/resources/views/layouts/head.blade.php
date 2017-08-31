<!DOCTYPE html>
<html>
	<head>
	<title>{!! config('config.application_title') ? : config('constants.ITEM_NAME') !!}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	<!-- BOOTSTRAP -->
	{!! HTML::style('assets/css/bootstrap.min.css') !!}

	{!! HTML::style('assets/third/select2/css/select2.css') !!}
	{!! HTML::style('assets/css/style.css') !!}
	{!! HTML::style('assets/css/style-responsive.css') !!}
	{!! HTML::style('assets/css/bootstrap.vertical-tabs.css') !!}
	@if($direction == 'rtl')
	{!! HTML::style('assets/css/bootstrap-rtl.css') !!}
	{!! HTML::style('assets/css/bootstrap-flipped.css') !!}
	@endif
	
    @if(in_array('mutidatepicker',$assets))
	{!! HTML::style('assets/third/multidatepicker/bootstrap-datepicker3.css') !!}
    @endif

    @if(in_array('calendar',$assets))
	{!! HTML::style('assets/third/fullcalendar/fullcalendar.min.css') !!}
	{!! HTML::style('assets/third/fullcalendar/fullcalendar.print.css', array('media' => 'print')) !!}
    @endif
    
    @if(in_array('datetimepicker',$assets))
	{!! HTML::style('assets/third/datetimepicker/bootstrap-datetimepicker.css') !!}
    @endif
	<!-- VENDOR -->
	{!! HTML::style('assets/third/pnotify/pnotify.custom.min.css') !!}
	{!! HTML::style('assets/css/animate.css') !!}
	{!! HTML::style('assets/third/font-awesome/css/font-awesome.min.css') !!}
	{!! HTML::style('assets/third/weather-icon/css/weather-icons.min.css') !!}
	{!! HTML::style('assets/third/morris/morris.css') !!}
	{!! HTML::style('assets/third/nifty-modal/css/component.css') !!}
	{!! HTML::style('assets/third/sortable/sortable-theme-bootstrap.css') !!}
	{!! HTML::style('assets/third/icheck/skins/flat/blue.css') !!}
	{!! HTML::style('assets/third/select/bootstrap-select.min.css') !!}
	{!! HTML::style('assets/third/summernote/summernote.css') !!}
	{!! HTML::style('assets/third/magnific-popup/magnific-popup.css') !!}
	{!! HTML::style('assets/third/datepicker/css/datepicker.css') !!}
	{!! HTML::style('assets/third/datatable/datatables.min.css') !!}
	{!! HTML::style('assets/third/slider/bootstrap-slider.min.css') !!}
	{!! HTML::style('assets/third/daterangepicker/daterangepicker.css') !!}
	{!! HTML::style('assets/css/custom.css') !!}

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- FAVICON -->
	<link rel="shortcut icon" href="{!! URL::to('assets/img/favicon.ico') !!}">
	<script> var public_path = "{!! URL::to('/'); !!}/"; </script>
	</head>
	
	
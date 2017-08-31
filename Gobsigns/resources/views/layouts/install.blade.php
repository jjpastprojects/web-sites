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
	{!! HTML::style('assets/css/animate.css') !!}
	{!! HTML::style('assets/third/pnotify/pnotify.custom.min.css') !!}
	{!! HTML::style('assets/third/font-awesome/css/font-awesome.min.css') !!}
	{!! HTML::style('assets/third/icheck/skins/flat/blue.css') !!}
	{!! HTML::style('assets/css/custom.css') !!}

	<!-- BODY -->
	<body class="tooltips full-content">
	
	<!-- BEGIN PAGE -->
	<div class="container">
	
		@yield('content')

	</div><!-- End div .container -->
	<!-- END PAGE -->

	<!--
	================================================
	JAVASCRIPT
	================================================
	-->
	<!-- Basic Javascripts (Jquery and bootstrap) -->
	{!! HTML::script('assets/js/jquery-1.11.3.min.js') !!}
	{!! HTML::script('assets/js/bootstrap.min.js') !!} 
	{!! HTML::script('assets/js/jquery.validate.min.js') !!}
	{!! HTML::script('assets/third/pnotify/pnotify.custom.min.js') !!}

	@include('notification')
	
	<!-- VENDOR -->

	<!-- Slimscroll js -->
	{!! HTML::script('assets/third/slimscroll/jquery.slimscroll.min.js') !!}

	<!-- Bootstrao selectpicker js -->
	{!! HTML::script('assets/third/select/bootstrap-select.min.js') !!}
	
	<!-- Summernote js -->
	{!! HTML::script('assets/third/summernote/summernote.js') !!}
	
	<!-- Bootstrap file input js -->
	{!! HTML::script('assets/third/input/bootstrap.file-input.js') !!}
	
	<!-- Bootstrao datepicker js -->
	{!! HTML::script('assets/third/datepicker/js/bootstrap-datepicker.js') !!}

	
	<!-- Icheck js -->
	{!! HTML::script('assets/third/icheck/icheck.min.js') !!}
	<!-- Form Wizard -->
	{!! HTML::script('assets/third/wizard/jquery.snippet.min.js') !!}
	{!! HTML::script('assets/third/wizard/jquery.easyWizard.js') !!}
	
	<!-- Form validation js -->
	{!! HTML::script('assets/js/validation-form.js') !!}
	{!! HTML::script('assets/js/wmlab.js') !!}
	
    <script>
	$(document).ready(function() { 
		Validate.init(); 
		$('#myWizard').easyWizard({
		buttonsClass: 'btn btn-default',
		submitButtonClass: 'btn btn-primary',
		showSteps: true,
	    showButtons: true,
	    submitButton: false
		});
	});
	</script>

	</body>
</html>
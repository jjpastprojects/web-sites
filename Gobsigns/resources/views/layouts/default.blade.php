@include('layouts.head')


	<!-- BODY -->
	<body class="tooltips k-rtl">
	
	<!-- BEGIN PAGE -->
	<div class="container">
		<!-- Your logo goes here -->
		<div class="logo-brand header sidebar rows">
			<div class="logo">
				<h1><a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/assets/img/ems-wtext.png') !!}" alt="Logo"> {!! config('config.application_name') !!} {!! config('constants.VERSION') !!}</a></h1>
				
			</div>
		</div><!-- End div .header .sidebar .rows -->

		@include('layouts.sidebar')
		
		<!-- BEGIN CONTENT -->
        <div class="right content-page">

			@include('layouts.header')	
			
			<!-- ============================================================== -->
			<!-- START YOUR CONTENT HERE -->
			<!-- ============================================================== -->
            <div class="body content rows scroll-y">

            	@if(!config('constants.MODE'))
            	<div class="alert alert-info"><strong>Employer Zone SAAS App is released. Visit <a href="http://emphrm.com" target=_blank>www.emphrm.com</a> & get your free account in just 5 minutes.</strong></div>
				@endif

				@yield('content')
			
				@include('layouts.footer')	
            </div>
			<!-- ============================================================== -->
			<!-- END YOUR CONTENT HERE -->
			<!-- ============================================================== -->
			
			
        </div>
		<!-- END CONTENT -->
		
	</div><!-- End div .container -->
	<!-- END PAGE -->

	<div class="modal fade" id="myTodoModal" role="basic" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			</div>
		</div>
	</div>
	
	@include('layouts.foot')	

		
	
	
	
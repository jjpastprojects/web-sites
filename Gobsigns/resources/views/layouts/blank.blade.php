@include('layouts.head')

	<!-- BODY -->
	<body class="tooltips k-rtl">
	
	<!-- BEGIN PAGE -->
	<div class="container">
		<!-- Your logo goes here -->
		<div class="logo-brand header sidebar rows">
			<div class="logo">
				<h1><a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/assets/img/ems-wtext.png') !!}" alt="Logo"> Employer Zone</a></h1>
			</div>
		</div><!-- End div .header .sidebar .rows -->
		
		<!-- BEGIN CONTENT -->
        <div class="content-page">
			
			<!-- ============================================================== -->
			<!-- START YOUR CONTENT HERE -->
			<!-- ============================================================== -->
            <div class="body content rows scroll-y">
				
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

	@include('layouts.foot')	

		
	
	
	
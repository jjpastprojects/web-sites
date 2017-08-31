
	<!--
	================================================
	JAVASCRIPT
	================================================
	-->
	<!-- Basic Javascripts (Jquery and bootstrap) -->
	{!! HTML::script('assets/third/fullcalendar/moment.min.js') !!}
	{!! HTML::script('assets/js/jquery-1.11.3.min.js') !!}
	{!! HTML::script('assets/js/bootstrap.min.js') !!} 
	{!! HTML::script('assets/js/jquery.validate.min.js') !!}
	{!! HTML::script('assets/js/textAvatar.js') !!}
	{!! HTML::script('assets/third/pnotify/pnotify.custom.min.js') !!}

	@include('notification')
	
	{!! HTML::script('assets/js/bootbox.js') !!}
	<!-- VENDOR -->

	<!-- Slimscroll js -->
	{!! HTML::script('assets/third/slimscroll/jquery.slimscroll.min.js') !!}

    @if(in_array('calendar',$assets))
	<!-- Full Calendar js -->
	{!! HTML::script('assets/third/fullcalendar/fullcalendar.min.js') !!}
	@endif

	<!-- select2 js -->
	{!! HTML::script('assets/third/select2/js/select2.min.js') !!}

	<!-- datatable js -->
	{!! HTML::script('assets/third/datatable/datatables.min.js') !!}
	
	<!-- Morris js -->
	{!! HTML::script('assets/third/raphael/raphael-min.js') !!}
	{!! HTML::script('assets/third/morris/morris.js') !!}
	
	<!-- Nifty modals js -->
	{!! HTML::script('assets/third/nifty-modal/js/classie.js') !!}
	{!! HTML::script('assets/third/nifty-modal/js/modalEffects.js') !!}
	
	<!-- Sortable js -->
	{!! HTML::script('assets/third/sortable/sortable.min.js') !!}
	
	<!-- Bootstrao selectpicker js -->
	{!! HTML::script('assets/third/select/bootstrap-select.min.js') !!}
	
	<!-- Summernote js -->
	{!! HTML::script('assets/third/summernote/summernote.js') !!}
	
	<!-- Magnific popup js -->
	{!! HTML::script('assets/third/magnific-popup/jquery.magnific-popup.min.js') !!}
	
	<!-- Bootstrap file input js -->
	{!! HTML::script('assets/third/input/bootstrap.file-input.js') !!}
	
	<!-- Bootstrao datepicker js -->
	{!! HTML::script('assets/third/datepicker/js/bootstrap-datepicker.js') !!}

	
	<!-- Icheck js -->
	{!! HTML::script('assets/third/icheck/icheck.min.js') !!}
	
    @if(in_array('mutidatepicker',$assets))
	{!! HTML::script('assets/third/multidatepicker/bootstrap-datepicker.js') !!}
    @endif

    @if(in_array('datetimepicker',$assets))
	{!! HTML::script('assets/third/datetimepicker/bootstrap-datetimepicker.js') !!}
    @endif

    {!! HTML::script('assets/third/daterangepicker/daterangepicker.js') !!}

	<!-- Form wizard js -->
	{!! HTML::script('assets/third/wizard/jquery.snippet.js') !!}
	{!! HTML::script('assets/third/wizard/jquery.easyWizard.js') !!}
	{!! HTML::script('assets/third/wizard/scripts.js') !!}

	<!-- Form validation js -->
	{!! HTML::script('assets/js/validation-form.js') !!}
	<!-- {!! HTML::script('assets/third/validator/bootstrapValidator.min.js') !!} -->
	<!-- {!! HTML::script('assets/third/validator/example.js') !!} -->

	<!-- Slider -->
	{!! HTML::script('assets/third/slider/bootstrap-slider.min.js') !!}

	{!! HTML::script('assets/js/wmlab.js') !!}

	{!! HTML::script('assets/js/reporting.js') !!}
	
    <script>
    
    @if(in_array('datetimepicker',$assets))
    $('.timepicker').datetimepicker({
		autoclose: 1,
		startView: 1});
    @endif 
    
    $("#reset-date-of-leaving").click(function(){
	    $('#date_of_leaving').val("");
	})
    $("#reset-date-of-joining").click(function(){
	    $('#date_of_joining').val("");
	})
    
	$(document).ready(function() { 
		$('.textAvatar').nameBadge();
		$("[data-toggle=popover]").popover({container: 'body'});
    	@if(in_array('calendar',$assets))
			$('#calendar').fullCalendar({
				header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
				events: {!! json_encode($events) !!},
				eventRender: function(event, element) {
			      	$(element).tooltip({title: event.title});             
			    }
			});
		@endif
		
		$('.showhide-textarea').hide();

		$(document).on('change', '#field_type', function(){
		 	var field = $('#field_type').val();
			if(field == 'select' || field == 'radio' || field == 'checkbox')
				$('.showhide-textarea').show();
			else
				$('.showhide-textarea').hide();
		});

		@if(in_array('mail_config',$assets))
			$('.mail_config').hide();
			@if(config('mail.driver') == 'mail')
			$('#mail_configuration').show();
			@elseif(config('mail.driver') == 'sendmail')
			$('#sendmail_configuration').show();
			@elseif(config('mail.driver') == 'log')
			$('#log_configuration').show();
			@elseif(config('mail.driver') == 'smtp')
			$('#smtp_configuration').show();
			@elseif(config('mail.driver') == 'mandrill')
			$('#mandrill_configuration').show();
			@elseif(config('mail.driver') == 'mailgun')
			$('#mailgun_configuration').show();
			@endif
			$(document).on('change', '#mail_driver', function(){
				$('.mail_config').hide();
			 	var field = $('#mail_driver').val();
				if(field == 'smtp')
					$('#smtp_configuration').show();
				else if(field == 'mandrill')
					$('#mandrill_configuration').show();
				else if(field == 'mailgun')
					$('#mailgun_configuration').show();
				else if(field == 'mail')
					$('#mail_configuration').show();
				else if(field == 'sendmail')
					$('#sendmail_configuration').show();
				else if(field == 'log')
					$('#log_configuration').show();
			});
		@endif

        $('.mdatepicker-input').datepicker();

		@if(in_array('graph',$assets))
		if ($('#morris-home').length > 0){
		//MORRIS
		Morris.Area({
		  element: 'morris-home',
		  data: [ {!! $graph_data !!}
		  ],
		  xkey: 'y',
		  ykeys: ['a'],
		  labels: ['Present Staff'],
		  resize: true,
		  lineColors: ['#5CB85C', '#2891CD']
		});
		}
		@endif

		// Javascript to enable link to tab
		var hash = document.location.hash;
		var prefix = "tab_";
		if (hash) {
		    $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown', function (e) {
		    window.location.hash = e.target.hash.replace("#", "#" + prefix);
		});

		Validate.init(); 

		$('.datatable').DataTable({
	        dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'li><'col-sm-7'p>>",
	        buttons: [
	            {
	                extend: 'print',
	                text: '<i class="fa fa-print"></i>',
	                title:"{!! $page_title !!}",
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'excel',
	                text: '<i class="fa fa-file-excel-o"></i>',
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'pdf',
	                text: '<i class="fa fa-file-pdf-o"></i>',
	                title:"{!! $page_title !!}",
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'copy',
	                text: '<i class="fa fa-files-o"></i>',
	                exportOptions: {
	                    columns: ':visible'
	                }
	            },
	            {
	                extend: 'colvis',
	                text: '<i class="fa fa-columns"></i>'
	            }
	        ],
    		"ajax": "{{ url('data.txt') }}",
    		"ordering": true,
    		"autoWidth": true,
    		"columnDefs": [
			    { "orderable": false, "targets": 0 }
			]
	    });
	});
	</script>

	</body>
</html>
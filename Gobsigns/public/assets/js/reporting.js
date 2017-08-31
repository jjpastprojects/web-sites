$(document).ready(function() {
	$('#transaction-date').daterangepicker({
		format: 'DD/MMM/YYYY',
	    startDate: moment().subtract(29, 'days'),
	    endDate: moment(),
	    minDate: '01/01/2000',
	    maxDate: '12/31/2050',
	    dateLimit: { days: 60 },
	    showDropdowns: true,
	    showWeekNumbers: true,
	    timePicker: false,
	    timePickerIncrement: 1,
	    timePicker12Hour: true,
	    ranges: {
	       'Today': [moment(), moment()],
	       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	       'This Month': [moment().startOf('month'), moment().endOf('month')],
	       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	    },
	    opens: 'left',
	    drops: 'down',
	    buttonClasses: ['btn', 'btn-sm'],
	    applyClass: 'btn-primary',
	    cancelClass: 'btn-default',
	    separator: ' to ',
	    locale: {
	        applyLabel: 'Submit',
	        cancelLabel: 'Cancel',
	        fromLabel: 'From',
	        toLabel: 'To',
	        customRangeLabel: 'Custom',
	        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
	        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	        firstDay: 1
	    }
	}, function(start, end, label) {
	    $('#transaction-date').html(start.format('DD/MMM/YYYY') + ' - ' + end.format('DD/MMM/YYYY'));

	    var start_date = start.format('YYYY-MM-DD');
	    var end_date = end.format('YYYY-MM-DD');

	    $.ajax({
	    	type: "GET",
	    	url: 'getlocations',
	    	datatype: 'json',
	    	data: {
	    		start_date: start_date,
	    		end_date: end_date
	    	},
	    	success: function (res) {
	    		data = jQuery.parseJSON(res);

	    		if (data.success == true) {
	    			locations = data.data;

	    			var html_request = "";
	    			var html_consultant = "";
	    			var html_advances = "";
	    			var html_sales = "";
	    			var html_district = "";
	    			var html_pl = "";
	    			for (var i = 0; i < locations.length; i++) {
	    				l = locations[i]
	    				
	    				html_request += "<tr>"
	    							+ "<td>"+l.created_date+"</td>"
	    							+ "<td>"+l.location+"</td>"
	    							+ "<td>"+l.client+"</td>"
	    							+ "<td>"+l.job_number+"</td>"
	    							+ "<td>$"+l.services_sign_rate+"</td>"
	    							+ "<td>$"+l.services_walker_rate+"</td>"
	    							+ "<td>$"+l.services_driver_rate+"</td>"
	    							+ "<td>$"+l.services_other+"</td>"
	    							+ "<td>$"+l.services_prepaid+"</td>"
	    							+ "<td>$"+l.services_deduction+"</td>"
	    							+ "<td>$"+l.services_balance_due+"</td>"
	    							+ "<td>$"+l.consultantfees_install_rate+"</td>"
    								+ "<td>$"+l.consultantfees_walker_rate+"</td>"
					        		+ "<td>$"+l.consultantfees_driver_rate+"</td>"
					        		+ "<td>$"+l.consultantfees_other+"</td>"
					        		+ "<td>$"+l.consultantfees_prepaid+"</td>"
					        		+ "<td>$"+l.consultantfees_deduction+"</td>"
					        		+ "<td>$"+l.consultantfees_balance_due+"</td>"
					        		+ "<td>$"+l.advances_walker_advance+"</td>"
					        		+ "<td>$"+l.advances_driver_advance+"</td>"
					        		+ "<td>$"+l.advances_other+"</td>"
					        		+ "<td>$"+l.advances_prepaid+"</td>"
					        		+ "<td>$"+l.advances_deduction+"</td>"
					        		+ "<td>$"+l.advances_balance_due+"</td>"
					        		+ "<td>$"+l.sales_amount+"</td>"
					        		+ "<td>$"+l.district_manager_amount+"</td>"
					        		+ "<td>$"+l.gross_profit_before_deduction+"</td>"
						        	+ "<td>$"+l.capital_deduction_amount+"</td>"
						        	+ "<td>$"+l.gross_profit_after_deduction+"</td>"
						        	+ "<td>"+l.gross_profit+"%</td>"
	    							+ "</tr>";
	    				
	    			}
	    			$('#service_request tbody').html(html_request);
	    		}
	    	},
	    	error: function (jqXHR, textStatus, errorThrown) {
	    		console.log(JSON.stringify(jqXHR));
	    	}
	    });
	});

	$('.location-save-btn .location-next-btn').click(function(e) {
		var current_tab = $('ul.ver-tab li.active a').html();
		
		if (current_tab == 'Location') {
			var client = $('#client_id').val();
			var location_id = $('#location_id').val();
			var job_number = $('#job_number').val();
			var store = $('#store').val();
			var address1 = $('#address1').val();
			var city = $('#city').val();
			var state = $('#state').val();
			var zip = $('#zip').val();
			var phone = $('#phone').val();

			if (client != '' && location_id != '' && job_number != '' && store != '' && address1 != '' 
				&& city != '' && state != '' && zip != '' && phone != '') {
				$('ul.ver-tab li.active a').parent().removeClass('active');
				$('ul.ver-tab li a[href="#contacts"]').parent().addClass('active');

				$('#location').removeClass('active');
				$('#contacts').addClass('active');

				$('.location-pre-btn').show();
			} else {
				$('.location-form').submit();
			}
		} else if (current_tab == 'Contacts') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#job_details"]').parent().addClass('active');

			$('#contacts').removeClass('active');
			$('#job_details').addClass('active');
		} else if (current_tab == 'Job Details') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#daily_schedule"]').parent().addClass('active');

			$('#job_details').removeClass('active');
			$('#daily_schedule').addClass('active');
		} else if (current_tab == 'Daily Schedule') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#temp_agency"]').parent().addClass('active');

			$('#daily_schedule').removeClass('active');
			$('#temp_agency').addClass('active');
		} else if (current_tab == 'Temp Agency') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#signage"]').parent().addClass('active');

			$('#temp_agency').removeClass('active');
			$('#signage').addClass('active');
		} else if (current_tab == 'Signage') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#accounting"]').parent().addClass('active');

			$('#signage').removeClass('active');
			$('#accounting').addClass('active');

			$('.location-next-btn').hide();
			$('.location-add-btn').show();
		}
	});

	$('.location-save-btn .location-pre-btn').click(function(e) {
		var current_tab = $('ul.ver-tab li.active a').html();

		if (current_tab == 'Accounting') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#signage"]').parent().addClass('active');

			$('#signage').addClass('active');
			$('#accounting').removeClass('active');

			$('.location-next-btn').show();
			$('.location-add-btn').hide();
		} else if (current_tab == 'Contacts') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#location"]').parent().addClass('active');

			$('#contacts').removeClass('active');
			$('#location').addClass('active');

			$('.location-pre-btn').hide();
		} else if (current_tab == 'Job Details') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#contacts"]').parent().addClass('active');

			$('#contacts').addClass('active');
			$('#job_details').removeClass('active');
		} else if (current_tab == 'Daily Schedule') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#job_details"]').parent().addClass('active');

			$('#job_details').addClass('active');
			$('#daily_schedule').removeClass('active');
		} else if (current_tab == 'Temp Agency') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#daily_schedule"]').parent().addClass('active');

			$('#daily_schedule').addClass('active');
			$('#temp_agency').removeClass('active');
		} else if (current_tab == 'Signage') {
			$('ul.ver-tab li.active a').parent().removeClass('active');
			$('ul.ver-tab li a[href="#temp_agency"]').parent().addClass('active');

			$('#temp_agency').addClass('active');
			$('#signage').removeClass('active');
		}
	});

	$('ul.ver-tab li a').click(function () {
		var current_tab = $(this).html();

		if (current_tab == 'Location') {
			$('.location-next-btn').show();
			$('.location-pre-btn').hide();
			$('.location-add-btn').show();
		} else if (current_tab == 'Accounting') {
			$('.location-next-btn').hide();
			$('.location-pre-btn').show();
			$('.location-add-btn').show();
		} else {
			$('.location-next-btn').show();
			$('.location-pre-btn').show();
			$('.location-add-btn').hide();
		}
	});

	var auto_calc_signwalker = function () {
		var mon_qty = isNaN(parseInt($('#signwalker_mon_qty').val())) ? 0 : parseInt($('#signwalker_mon_qty').val());
		var mon_hour = isNaN(parseInt($('#signwalker_mon_hours').val())) ? 0 : parseInt($('#signwalker_mon_hours').val());
		var tue_qty = isNaN(parseInt($('#signwalker_tue_qty').val())) ? 0 : parseInt($('#signwalker_tue_qty').val());
		var tue_hour = isNaN(parseInt($('#signwalker_tue_hours').val())) ? 0 : parseInt($('#signwalker_tue_hours').val());
		var wed_qty = isNaN(parseInt($('#signwalker_wed_qty').val())) ? 0 : parseInt($('#signwalker_wed_qty').val());
		var wed_hour = isNaN(parseInt($('#signwalker_wed_hours').val())) ? 0 : parseInt($('#signwalker_wed_hours').val());
		var thu_qty = isNaN(parseInt($('#signwalker_thu_qty').val())) ? 0 : parseInt($('#signwalker_thu_qty').val());
		var thu_hour = isNaN(parseInt($('#signwalker_thu_hours').val())) ? 0 : parseInt($('#signwalker_thu_hours').val());
		var fri_qty = isNaN(parseInt($('#signwalker_fri_qty').val())) ? 0 : parseInt($('#signwalker_fri_qty').val());
		var fri_hour = isNaN(parseInt($('#signwalker_fri_hours').val())) ? 0 : parseInt($('#signwalker_fri_hours').val());
		var sat_qty = isNaN(parseInt($('#signwalker_sat_qty').val())) ? 0 : parseInt($('#signwalker_sat_qty').val());
		var sat_hour = isNaN(parseInt($('#signwalker_sat_hours').val())) ? 0 : parseInt($('#signwalker_sat_hours').val());
		var sun_qty = isNaN(parseInt($('#signwalker_sun_qty').val())) ? 0 : parseInt($('#signwalker_sun_qty').val());
		var sun_hour = isNaN(parseInt($('#signwalker_sun_hours').val())) ? 0 : parseInt($('#signwalker_sun_hours').val());

		var total_qty = mon_qty + tue_qty + wed_qty + thu_qty + fri_qty + sat_qty + sun_qty;
		total_qty = (total_qty == '') ? 0 : total_qty;

		var total_hours = mon_hour + tue_hour + wed_hour + thu_hour + fri_hour + sat_hour + sun_hour;
		total_hours = (total_hours == '') ? 0 : total_hours;

		$('#signwalker_total_walkers').val(total_qty);
		$('#signwalker_total_hours').val(total_hours);

		var hourly_rate = $('#signwalker_hourly_rate').val() * 1;
		var total_amount = hourly_rate * total_qty * total_hours;

		$('#signwalker_total_amount').val(total_amount);
	}

	$('#signwalker_mon_qty').on('change', auto_calc_signwalker);
	$('#signwalker_mon_qty').on('keyup', auto_calc_signwalker);
	$('#signwalker_mon_hours').on('change', auto_calc_signwalker);
	$('#signwalker_mon_hours').on('keyup', auto_calc_signwalker);

	$('#signwalker_tue_qty').on('change', auto_calc_signwalker);
	$('#signwalker_tue_qty').on('keyup', auto_calc_signwalker);
	$('#signwalker_tue_hours').on('change', auto_calc_signwalker);
	$('#signwalker_tue_hours').on('keyup', auto_calc_signwalker);

	$('#signwalker_wed_qty').on('change', auto_calc_signwalker);
	$('#signwalker_wed_qty').on('keyup', auto_calc_signwalker);
	$('#signwalker_wed_hours').on('change', auto_calc_signwalker);
	$('#signwalker_wed_hours').on('keyup', auto_calc_signwalker);

	$('#signwalker_thu_qty').on('change', auto_calc_signwalker);
	$('#signwalker_thu_qty').on('keyup', auto_calc_signwalker);
	$('#signwalker_thu_hours').on('change', auto_calc_signwalker);
	$('#signwalker_thu_hours').on('keyup', auto_calc_signwalker);

	$('#signwalker_fri_qty').on('change', auto_calc_signwalker);
	$('#signwalker_fri_qty').on('keyup', auto_calc_signwalker);
	$('#signwalker_fri_hours').on('change', auto_calc_signwalker);
	$('#signwalker_fri_hours').on('keyup', auto_calc_signwalker);

	$('#signwalker_sat_qty').on('change', auto_calc_signwalker);
	$('#signwalker_sat_qty').on('keyup', auto_calc_signwalker);
	$('#signwalker_sat_hours').on('change', auto_calc_signwalker);
	$('#signwalker_sat_hours').on('keyup', auto_calc_signwalker);

	$('#signwalker_sun_qty').on('change', auto_calc_signwalker);
	$('#signwalker_sun_qty').on('keyup', auto_calc_signwalker);
	$('#signwalker_sun_hours').on('change', auto_calc_signwalker);
	$('#signwalker_sun_hours').on('keyup', auto_calc_signwalker);

	$('#signwalker_hourly_rate').on('change', auto_calc_signwalker);
	$('#signwalker_hourly_rate').on('keyup', auto_calc_signwalker);


	var auto_calc_signdriver = function () {
		var mon_qty = isNaN(parseInt($('#signdriver_mon_qty').val())) ? 0 : parseInt($('#signdriver_mon_qty').val());
		var mon_hour = isNaN(parseInt($('#signdriver_mon_hours').val())) ? 0 : parseInt($('#signdriver_mon_hours').val());
		var tue_qty = isNaN(parseInt($('#signdriver_tue_qty').val())) ? 0 : parseInt($('#signdriver_tue_qty').val());
		var tue_hour = isNaN(parseInt($('#signdriver_tue_hours').val())) ? 0 : parseInt($('#signdriver_tue_hours').val());
		var wed_qty = isNaN(parseInt($('#signdriver_wed_qty').val())) ? 0 : parseInt($('#signdriver_wed_qty').val());
		var wed_hour = isNaN(parseInt($('#signdriver_wed_hours').val())) ? 0 : parseInt($('#signdriver_wed_hours').val());
		var thu_qty = isNaN(parseInt($('#signdriver_thu_qty').val())) ? 0 : parseInt($('#signdriver_thu_qty').val());
		var thu_hour = isNaN(parseInt($('#signdriver_thu_hours').val())) ? 0 : parseInt($('#signdriver_thu_hours').val());
		var fri_qty = isNaN(parseInt($('#signdriver_fri_qty').val())) ? 0 : parseInt($('#signdriver_fri_qty').val());
		var fri_hour = isNaN(parseInt($('#signdriver_fri_hours').val())) ? 0 : parseInt($('#signdriver_fri_hours').val());
		var sat_qty = isNaN(parseInt($('#signdriver_sat_qty').val())) ? 0 : parseInt($('#signdriver_sat_qty').val());
		var sat_hour = isNaN(parseInt($('#signdriver_sat_hours').val())) ? 0 : parseInt($('#signdriver_sat_hours').val());
		var sun_qty = isNaN(parseInt($('#signdriver_sun_qty').val())) ? 0 : parseInt($('#signdriver_sun_qty').val());
		var sun_hour = isNaN(parseInt($('#signdriver_sun_hours').val())) ? 0 : parseInt($('#signdriver_sun_hours').val());

		var total_qty = mon_qty + tue_qty + wed_qty + thu_qty + fri_qty + sat_qty + sun_qty;
		total_qty = (total_qty == '') ? 0 : total_qty;

		var total_hours = mon_hour + tue_hour + wed_hour + thu_hour + fri_hour + sat_hour + sun_hour;
		total_hours = (total_hours == '') ? 0 : total_hours;

		$('#signdriver_total_walkers').val(total_qty);
		$('#signdriver_total_hours').val(total_hours);

		var hourly_rate = $('#signdriver_hourly_rate').val() * 1;
		var total_amount = hourly_rate * total_qty * total_hours;

		$('#signdriver_total_amount').val(total_amount);
	}

	$('#signdriver_mon_qty').on('change', auto_calc_signdriver);
	$('#signdriver_mon_qty').on('keyup', auto_calc_signdriver);
	$('#signdriver_mon_hours').on('change', auto_calc_signdriver);
	$('#signdriver_mon_hours').on('keyup', auto_calc_signdriver);

	$('#signdriver_tue_qty').on('change', auto_calc_signdriver);
	$('#signdriver_tue_qty').on('keyup', auto_calc_signdriver);
	$('#signdriver_tue_hours').on('change', auto_calc_signdriver);
	$('#signdriver_tue_hours').on('keyup', auto_calc_signdriver);

	$('#signdriver_wed_qty').on('change', auto_calc_signdriver);
	$('#signdriver_wed_qty').on('keyup', auto_calc_signdriver);
	$('#signdriver_wed_hours').on('change', auto_calc_signdriver);
	$('#signdriver_wed_hours').on('keyup', auto_calc_signdriver);

	$('#signdriver_thu_qty').on('change', auto_calc_signdriver);
	$('#signdriver_thu_qty').on('keyup', auto_calc_signdriver);
	$('#signdriver_thu_hours').on('change', auto_calc_signdriver);
	$('#signdriver_thu_hours').on('keyup', auto_calc_signdriver);

	$('#signdriver_fri_qty').on('change', auto_calc_signdriver);
	$('#signdriver_fri_qty').on('keyup', auto_calc_signdriver);
	$('#signdriver_fri_hours').on('change', auto_calc_signdriver);
	$('#signdriver_fri_hours').on('keyup', auto_calc_signdriver);

	$('#signdriver_sat_qty').on('change', auto_calc_signdriver);
	$('#signdriver_sat_qty').on('keyup', auto_calc_signdriver);
	$('#signdriver_sat_hours').on('change', auto_calc_signdriver);
	$('#signdriver_sat_hours').on('keyup', auto_calc_signdriver);

	$('#signdriver_sun_qty').on('change', auto_calc_signdriver);
	$('#signdriver_sun_qty').on('keyup', auto_calc_signdriver);
	$('#signdriver_sun_hours').on('change', auto_calc_signdriver);
	$('#signdriver_sun_hours').on('keyup', auto_calc_signdriver);

	$('#signdriver_hourly_rate').on('change', auto_calc_signdriver);
	$('#signdriver_hourly_rate').on('keyup', auto_calc_signdriver);


	$('.reporting-table').DataTable({
        dom: "<'row'<'col-sm-3'B>>",
        buttons: [
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                title:"reporting",
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
                title:"reorting",
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
		//"ajax": "{{ url('/getlocations') }}",
		"ordering": false,
		"autoWidth": true,
		"columnDefs": [
		    { "orderable": false, "targets": 0 }
		]
    });
});
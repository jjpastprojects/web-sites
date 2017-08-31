var Validate = function () {
	var handleLogin = function() {
   		$('.login-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                username: {
	                    required: true,
	                },
	                password: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleForgot = function() {
   		$('.forgot-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                email: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleTemplate = function() {
   		$('.template-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                template_subject: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleRole = function() {
   		$('.role-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                name: {
	                    required: true,
	                },
	                display_name: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleJob = function() {
   		$('.job-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                job_title: {
	                    required: true,
	                },
	                location_id: {
	                    required: true,
	                },
	                numbers: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleJobApplication = function() {
   		$('.job-application-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                job_id: {
	                    required: true,
	                },
	                name: {
	                    required: true,
	                },
	                email: {
	                    required: true,
	                },
	                resume: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleExpenseHead = function() {
   		$('.expense-head-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                expense_head: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleLanguageEntry = function() {
   		$('.language-entry-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                text: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}


	var handleClient = function() {
   		$('.client-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                client_name: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}


	var handleLanguage = function() {
   		$('.language-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                locale: {
	                    required: true,
	                },
	                name: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}	

	var handleLocation = function() {
   		$('.location-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                client_id: {
	                    required: true,
	                },
	                location: {
	                    required: true,
	                },
	                job_number: {
	                    required: true,
	                },
	                store: {
	                    required: true,
	                },
	                address1: {
	                    required: true,
	                },
	                city: {
	                    required: true,
	                },
	                state: {
	                    required: true,
	                },
	                zip: {
	                    required: true,
	                    digits: true
	                },
	                phone: {
	                    required: true,
	                },/*
	                fax: {
	                    required: true,
	                },*/
	                branch_email: {
	                	email: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}


	var handleChangePassword = function() {

   		$('.change-password-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                old_password: {
	                    required: true,
	                },
	                new_password: {
	                    required: true,
	                },
	                new_password_confirmation: {
	                    required: true,
	                    equalTo: "#new_password"
	                },
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}		

	var handleEmployee = function() {

   		$('.employee-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                first_name: {
	                    required: true,
	                },
	                last_name: {
	                    required: true,
	                },
	                location_id: {
	                    required: true,
	                },
	                role_id: {
	                    required: true,
	                },
	                username: {
	                    required: true,
	                },
	                email: {
	                    required: true,
	                    email: true
	                },
	                mobile_phone: {
	                    required: true,
	                },
	                password: {
	                    required: true,
	                },
	                password_confirmation: {
	                    required: true,
	                    equalTo: "#password"
	                },
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}		

	var handleNotice = function() {

   		$('.notice-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                title: {
	                    required: true,
	                },
	                from_date: {
	                    required: true,
	                },
	                to_date: {
	                    required: true,
	                },
	                location_id: {
	                    required: true,
	                },
	                content: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}	

	var handleTicket = function() {

   		$('.ticket-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                ticket_subject: {
	                    required: true,
	                },
	                ticket_priority: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}	

	var handleHoliday = function() {

   		$('.holiday-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                date: {
	                    required: true,
	                },
	                holiday_description: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}	

	var handleAwardType = function() {

   		$('.award-type-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                award_name: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}	

	var handleLeaveType = function() {

   		$('.leave-type-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                leave_name: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}	

	var handleDocumentType = function() {

   		$('.document-type-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                document_type_name: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}		

	var handleAward = function() {

   		$('.award-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                user_id: {
	                    required: true,
	                },
	                award_type_id: {
	                    required: true,
	                },
	                month: {
	                    required: true,
	                },
	                year: {
	                    required: true,
	                },
	                cash: {
	                    number: true,
	                },
	                award_date: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}	

	var handleBankAccount = function() {

   		$('.bank-account-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                bank_name: {
	                    required: true,
	                },
	                account_name: {
	                    required: true,
	                },
	                account_number: {
	                    required: true,
	                },
	                ifsc_code: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleDocument = function() {

   		$('.document-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                document_type: {
	                    required: true,
	                },
	                document_file: {
	                    required: true,
	                },
	                document_title: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleLeave = function() {

   		$('.leave-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                user_id: {
	                    required: true,
	                },
	                leave_type_id: {
	                    required: true,
	                },
	                from_date: {
	                    required: true,
	                },
	                to_date: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleTask = function() {

   		$('.task-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                task_title: {
	                    required: true,
	                },
	                start_date: {
	                    required: true,
	                },
	                due_date: {
	                    required: true,
	                },
	                user_id: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleSalaryType = function() {

   		$('.salary-type-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                salary_type: {
	                    required: true,
	                },
	                salary_head: {
	                    required: true,
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handleTaskProgress = function() {

   		$('.task-progress-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                task_progress: {
	                    required: true,
	                    number:true,
	                    max:100,
	                    min:0
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

	var handlePayroll = function() {

   		$('.payroll-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            rules: {
	                month: {
	                    required: true
	                },
	                year: {
	                    required: true
	                },
	                user_id: {
	                    required: true
	                }
	            },

	            highlight: function (element) {
	                $(element)
	                    .closest('.form-group').addClass('has-error');
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });
	}

    return {
        init: function () {
            handleLogin();
            handleChangePassword();
            handleClient();
            handleForgot();
            handleLocation();
            handleEmployee();
            handleNotice();
            handleHoliday();
            handleAwardType();
            handleLeaveType();
            handleAward();
            handleBankAccount();
            handleDocument();
            handleLeave();
            handleTask();
            handleSalaryType();
            handleTaskProgress();
            handlePayroll();
            handleLanguage();
            handleTicket();
            handleRole();
            handleExpenseHead();
            handleLanguageEntry();
            handleJob();
            handleJobApplication();
            handleTemplate();
            handleDocumentType();

            jQuery(document).on("click", ".alert_delete", function(e) {
	            var link = jQuery(this).attr("href"); 
	            e.preventDefault();    
	            bootbox.confirm("Deleting this entirty will result in deleting all linked data with it. It cannot be undone. Are you sure want to proceed? ", function(result) {    
	                if (result) {
	                    document.location.href = link;     
	                }    
	            });
	        });

	        
            jQuery(document).on("click", "[data-submit-confirm-text]", function(e) {
		        var $el = $(this);
		        e.preventDefault();
		        var confirmText = 'Deleting this entirty will result in deleting all linked data with it. It cannot be undone. Are you sure want to proceed? ';
		        bootbox.confirm(confirmText, function(result) {
		            if (result) {
		                $el.closest('form').submit();
		            }
		        });
		    });
        }
    };
}();

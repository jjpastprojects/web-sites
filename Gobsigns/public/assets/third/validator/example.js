$(document).ready(function() {
	
    $('#client-form').bootstrapValidator({
        message: 'This value is not valid!!',
        fields: {
            client_name: {
                message: 'Please enter name!!',
                validators: {
                    notEmpty: {
                        message: 'Name is required and can\'t be empty!!'
                    }
                }
            }
        }
    });
	
});
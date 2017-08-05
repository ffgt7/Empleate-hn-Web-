$(document).ready(function() {
    $('#formBlog').bootstrapValidator({
	
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
	
        fields: {
            categoria: {
                validators: {
                        
                        notEmpty: {
                        message: 'La catègoria es obligatorio'
                    }
                }
            }, 
			blog: {
                 validators: {
                    notEmpty: {
                        message: 'El articulo es obligatorio'
                    }
                }
            }
		}
	});
 });
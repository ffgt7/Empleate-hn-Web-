$(document).ready(function() {
    $('#contactForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            asunto: {
                validators: {
                        stringLength: {
                        min:10,
			max:100 ,
                    }
                }
            },
			texto: {
                validators: {
                        stringLength: {
                        min:10,
			max:100 ,
                    }
                }
            }
	
			
            }
        })
        
});
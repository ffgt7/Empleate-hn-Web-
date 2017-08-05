$(document).ready(function() {
    $('#contact_form2').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

			carrera:{
				validators:{
					stringLength:{
						min:2,
						max:4
					},
					notEmpty: {
                        message: 'El nombre de la carrera es obligatorio'
                    }
				}
			},
			superiorI: {
                validators: {
			stringLength: {
                        	min: 4,
				max:4,
                    },
                    
		regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: '*Solo puede contener números'
},
					notEmpty: {
                        message: 'El año de inicio obligatorio'
                    }  
                    
                }
            },
				superiorF: {
                validators: {
			stringLength: {
                        	min: 4,
				max:4,
                    },
                    
		regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: '*Solo puede contener números'
		},
					notEmpty: {
                        message: 'El año de finalización obligatorio'
                    }
                    
                }
            }
            }
        })
        
});
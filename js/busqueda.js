$(document).ready(function() {
    $('#busqueda').bootstrapValidator({
	
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
	
        fields: {
            salario: {
                validators: {
                        stringLength: {
						max: 10
                    },
					regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'Solo se permiten números'
					}	
                }
            },
			edad: {
                validators: {
                        stringLength: {
						max: 10
                    },
					regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'Solo se permiten números'
					}	
                }
            },
			edad2: {
                validators: {
                        stringLength: {
						max: 10
                    },
					regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'Solo se permiten números'
					}	
                }
            },
			empre: {
                validators: {
                        stringLength: {
						max: 150
                    }
                }
            },
			salario2: {
                validators: {
                        stringLength: {
						max: 10
                    },
					regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'Solo se permiten números'
					}	
                }
            }
		}
        });
});
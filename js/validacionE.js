$(document).ready(function() {
    $('#contact_form2').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            primaria: {
                validators: {
                        stringLength: {
                        min:10,
			max:100 ,
                    },
					notEmpty: {
                        message: 'El nombre del centro es obligatorio'
                    }
                }
            },
			
			
             
			 primariaI: {
                validators: {
			stringLength: {
                        	min:4,
				max:4,
                    },
                    
		regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: '*Solo puede contener números'
},
					notEmpty: {
                        message: 'El año de inicio es obligatorio'
                    }
                    
                }
            },
			
			 primariaF: {
                validators: {
			stringLength: {
                        	min:4,
				max:4,
                    },
                    
		regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: '*Solo puede contener números'
},
					notEmpty: {
                        message: 'El año de finalización es obligatorio'
                    }
                    
                }
            },
				
			 
             secundaria: {
                validators: {
                        stringLength: {
                        min:10,
			max:100 ,
                    },
					notEmpty: {
                        message: 'El nombre del centro es obligatorio'
                }
                    }
            },
			
			secundariaI: {
                validators: {
			stringLength: {
                        	min:4,
				max:4,
                    },
                    
		regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: '*Solo puede contener números'
},
					notEmpty: {
                        message: 'El año de inicio es obligatorio'
                    }
                    
                }
            },	
			
			secundariaF: {
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
                        message: 'El año de finalización es obligatorio'
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
}
                    
                }
            },
			tituloObtenidoSecu: {
                validators: {
			stringLength: {
                        	min: 2,
				max:100,
                    },
					notEmpty: {
                        message: 'El titulo obtenido es obligatorio'
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
}
                    
                }
            }
            }
        })
        
});
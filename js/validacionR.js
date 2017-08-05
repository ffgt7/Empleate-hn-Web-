		$(document).ready(function() {
			$('#contact_form5').bootstrapValidator({
				// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					
					
					nombreR: {
						validators: {
								stringLength: {  
								
									max:25 
							},
								notEmpty: {
								message: '*El nombre es obligatorio'
							}
						}
					},
				
					
				apellidoR: {
						validators: {
							 stringLength: {
						   
					max:25
							},
							notEmpty: {
								message: '*El apellido es obligatorio'
							}
						}
					},
					
				identidadR:{
					validators: {
				stringLength: {
								min: 13,
					max:13,
						},
						notEmpty: {
							message: '*Ingrese el número de identidad'
						},
			regexp: {
	 
						 regexp: /^[0-9]+$/,
	 
						 message: '*Solo puede contener números'
	}
						
					}
				},
					
					
					 direccionR: {
					validators: {
						  stringLength: {
							min: 10,
						   
							message:'*Introduzca un minimo de 10 letras '
						},
						notEmpty: {
							message: '*La dirección de la referencia es obligatoria'
						}
						}
					},
				
						
					telFR: {
					validators: {
				stringLength: {
								min: 7,
					max:8,
						},
						
			regexp: {
	 
						 regexp: /^[0-9]+$/,
	 
						 message: '*Solo puede contener números'
	}
						
					}
				},	
				
				telMR: {
					validators: {
				stringLength: {
								min: 7,
					max:8,
						},
						
			regexp: {
	 
						 regexp: /^[0-9]+$/,
	 
						 message: '*Solo puede contener números'
	}
						
					}
				},
				
				
				correoR: {
						validators: {
								stringLength: {  
								
									max:55 
							},
						}
					},
					
			}})
			   /* .on('success.form.bv', function(e) {
					$('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
						$('#contact_form5').data('bootstrapValidator').resetForm();

					// Prevent form submission
					e.preventDefault();

					// Get the form instance
					var $form = $(e.target);

					// Get the BootstrapValidator instance
					var bv = $form.data('bootstrapValidator');

					// Use Ajax to submit form data
					$.post($form.attr('action'), $form.serialize(), function(result) {
						console.log(result);
					}, 'json');
				});*/
				
		});
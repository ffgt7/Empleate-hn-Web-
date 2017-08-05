  $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
	
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
	
        fields: {
            NombreTextBox: {
                validators: {
                        stringLength: {
                        min: 2,
			max: 15,
                    },
                        notEmpty: {
                        message: 'El nombre de usuario es obligatorio'
                    }
                }
            },
			imagen: {
                validators: {
                     file: {
						extension: 'jpg,jpeg,png,gif',
						type: 'image/jpeg,image/png',
						message: 'Seleccione una imagen con un tamaño menor a 4 MB y un formato valido (jpg,jpeg,png,gif)',
						maxSize: 4000000,
						minSize: 1
					}
				}
            },
             Contrase: {
                validators: {
                     stringLength: {
                        min: 8,
			max:50,
                    },
                    notEmpty: {
                        message: 'La contraseña es obligatoria'
                    }
                }
            },
            Confircontrase: {
                validators: {
                    stringLength: {
                        min: 8,
                    },
 		    identical: {
                        field: 'Contrase',
                        message: 'La contraseña y su confirmación no son los mismos'
                    },
                    notEmpty: {
                        message: 'Repita su contraseña'
                    }
                }
            },
	    pregunta: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una pregunta de seguridad'
                    }
                }
            },
            Resp_Segu: {
                validators: {
                     stringLength: {
                        min: 2,
			max: 60,
                    },
                    notEmpty: {
                        message: 'Responda a la pregunta de seguridad'
                    }
                }
            },
            NombEmpresa: {
                validators: {
                     stringLength: {
                        min: 1,
			max: 150,
                    },
                    notEmpty: {
                        message: 'Introduzca el nombre de su empresa'
                    }
                }
            },
            Correo: {
                validators: {
                    emailAddress: {
                        message: 'Ingrese un correo electrónico valido'
                    }
                }
            },
            Num_Tel: {
                validators: {
			stringLength: {
                        	min: 8,
				max:15,
                    },
                    notEmpty: {
                        message: 'Ingrese su número de telefono'
                    },
		regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'El teléfono solo puede contener números'
}
                    
                }
            },
	     Rub_Empre: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el rubro de su empresa'
                    }
                }
            },	
            Descrip_Empre: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 300,
                        message:'Introduzca un minimo de 10 letras y un máximo de 300'
                    },
                    notEmpty: {
                        message: 'La descripcion de la empresa es obligatoria'
                    }
                    }
                }
            }
        });
/*        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

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
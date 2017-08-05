  $(document).ready(function() {
    $('#formUser').bootstrapValidator({
	
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
	
        fields: {
            Nomb_Usuario: {
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
			imagen_Usuario: {
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
	    Apellidos_Usuario: {
                validators: {
                     stringLength: {
                        min: 3,
			max: 85,
                    },
                    notEmpty: {
                        message: 'Sus apellidos son obligatorios'
                    }
                }
            },
            NombUser: {
                validators: {
                     stringLength: {
                        min: 3,
			max: 100,
			
                    },
                    notEmpty: {
                        message: 'Sus nombres son obligatorios'
                    }
                }
            },
			identidadC:{
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
	 
						 message: '*solo puede contener números'
					}
						
						}
							},
			lugarNC: {
						validators: {
							 stringLength: {
						   
					max:50
							}
						}
					},
            Nacionalidad_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione su nacionalidad'
                    }
                }
            },
	    Sexo_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione su sexo'
                    }
                }
            },
            Depart_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione un departamento'
                    }
                }
            },
             Muni_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione un municipio'
                    }
                }
            },
            Direcc_Usuario: {
                validators: {
                     stringLength: {
                        min: 10,
			max: 255,
			
                    },
                    notEmpty: {
                        message: 'Su dirección es obligatoria'
                    }
                }
            },
            TelFijo_Usuario: {
                validators: {
			stringLength: {
                        	min: 8,
				max:15,
				
                    },   
		regexp: {
 			regexp: /^[0-9]+$/,
 			message: 'El número de teléfono solo puede contener números'
		}
              }
            },
            TelMovil_Usuario: {
                validators: {
			stringLength: {
                        	min: 8,
				max:15,
				
                    }, 
                    notEmpty: {
                        message: 'Su teléfono móvil es obligatorio'
                    }, 
		regexp: {
 			regexp: /^[0-9]+$/,
 			message: 'El número de teléfono solo puede contener números'
		}
              }
            },
            TelRefer_Usuario: {
                validators: {
			stringLength: {
                        	min: 8,
				max:15,
				message:'Introduzca un minimo de 8 números y un maximo de 15'
                    }, 
                      
		regexp: {
 			regexp: /^[0-9]+$/,
 			message: 'El camp de teléfono solo puede contener números'
		}
              }
            },
            Correo_Usuario: {
                validators: {
                    emailAddress: {
                        message: 'Ingrese un correo electronico valido'
                    },
                    notEmpty: {
                        message: 'El correo electronico es obligatorio'
                    }
                }
            },
            Vehi_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una respuesta'
                    }
                }
            },	
            Moto_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una respuesta'
                    }
                }
            },	
            Licen_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una respuesta'
                    }
                }
            },	
            TipLicen_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una respuesta'
                    }
                }
            },
            Descrip_Usuario: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 500,
                        
                    },
                    notEmpty: {
                        message: 'La descripcion es obligatoria'
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
  $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
	
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
	
        fields: {
            nombre: {
                validators: {
                        stringLength: {
                        min: 2,
			max: 100,
                    },
                        notEmpty: {
                        message: 'El nombre de de la oferta es obligatorio'
                    }
                }
            }, 
			area: {
                 validators: {
                    notEmpty: {
                        message: 'Seleccione un area de la empresa'
                    }
                }
            },
			cargo: {
                validators: {
                     stringLength: {
                        min: 2,
			max:80,
                    },
                    notEmpty: {
                        message: 'escriba el cargo a desempeñar'
                    }
                }
            },
			vacantes: {
                validators: {
					stringLength: {
                        min: 1,
			max:3,
                    },
                    notEmpty: {
                        message: 'Ingrese el número de vacantes disponibles'
                    },
			regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'solo puede contener números'
                    }
                    
                }
            },
			tipoCont: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el horario de trabajo'
                    }
                }
            },
			departamentoV: {
                validators: {
					stringLength: {
                        min: 10,
			max: 50,
                    },
                    notEmpty: {
                        message: 'Ingrese el lugar donde se ubica la vacante'
                    }
                }
            },
			Muni_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el departamento donde se hubica la vacante'
                    }
                }
            },
			Depart_Usuario: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el departamento donde se hubica la vacante'
                    }
                }
            },
			salario: {
                validators: {
			stringLength: {
                        	min: 3,
				max:10,
                    },
                    
			regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'solo puede contener números'
					}
                    
                }
            },
			salario2: {
                validators: {
			stringLength: {
                        	min: 3,
				max:10,
                    },
                    
			regexp: {
 
					 regexp: /^[0-9]+$/,
 
					 message: 'solo puede contener números'
					}
                    
                }
            },
			caducidad: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione la fecha de vencimiento'
                    }
                }
            },
			experienciaLab: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione la experiencia requerida en el puesto'
                    }
                }
            },
			titulo: {
                validators: {
                     stringLength: {
                        min: 2,
			max: 100,
                    },
                    notEmpty: {
                        message: 'Escriba la titulo requerido para el puesto'
                    }
                }
            },
			genero: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el genero preferencial de aspirante'
                    }
                }
            },
			edad: {
                validators: {
                     stringLength: {
                        min: 2,
			max: 2,
                    },
                    notEmpty: {
                        message: 'Seleccione la edad minima del aspirante'
                    },
					regexp: {
		 	regexp: /^[0-9]+$/,
					 message: 'solo puede contener números'
					}
                }
            },
			edad2: {
                validators: {
                     stringLength: {
                        min: 2,
			max: 2,
                    },
                    notEmpty: {
                        message: 'Seleccione la edad maxima del aspirante'
                    },
					regexp: {
		 	regexp: /^[0-9]+$/,
					 message: 'solo puede contener números'
					}
                }
            },
			vehiculo: {
                validators: {
                     stringLength: {
                        min: 5,
			max: 11,
                    },
                    
                }
            },
			tipoLicen: {
                validators: {
                     stringLength: {
                        min: 6,
			max: 11,
                    },
                    
                }
            },
			descripcion: {
                validators: {
                      stringLength: {
                        min: 10,
                max: 1000,
                        message:'Introduzca un minimo de 10 letras y un maximo de 300'
                    },
                    notEmpty: {
                        message: 'La descripcion de la oferta de trabajo es obligatoria'
                    }
                    }
            },
			descripcion2: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 1000,
                        message:'Introduzca un minimo de 10 letras y un maximo de 300'
                    },
                    notEmpty: {
                        message: 'Las funciones a desempeñar en el cargo son obligatorias'
                    }
                    }
                },
				descripcion3: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 1000,
                        message:'Introduzca un minimo de 10 letras y un maximo de 300'
                    },
                    notEmpty: {
                        message: 'El objetivo del cargo es obligatorio'
                    }
                    }
                }
		}
	});
 });
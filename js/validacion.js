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
			max:25 ,
                    },
                        notEmpty: {
                        message: 'El nombre de la propuesta es obligatorio'
                    }
                }
            },
			area: {
                validators: {
                    notEmpty: {
                        message: 'seleccione un area de la empresa'
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
			tipo: {
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
                     stringLength: {
                        min: 9,
			max: 11,
                    },
                    notEmpty: {
                        message: 'Seleccione el departamento donde se hubica la vacante'
                    }
                }
            },
			experienciaLab: {
                validators: {
                     stringLength: {
                        min: 20,
			max: 100,
                    },
                    notEmpty: {
                        message: 'Escriba la experiencia requerida en el puesto'
                    }
                }
            },
			titulo: {
                validators: {
                     stringLength: {
                        min: 10,
			max: 30,
                    },
                    notEmpty: {
                        message: 'Escriba la titulo requerido para el puesto'
                    }
                }
            },
			idioma: {
                validators: {
                     stringLength: {
                        min: 10,
			max: 30,
                    },
                    
                }
            },
			genero: {
                validators: {
                     stringLength: {
                        min: 8,
			max: 11,
                    },
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
                        message: 'Seleccione la edad del aspirante'
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
                        message: 'Seleccione la edad del aspirante'
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
			max: 7,
                    },
                    
                }
            },
			descripcion: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 300,
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
                        max: 300,
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
                        max: 300,
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
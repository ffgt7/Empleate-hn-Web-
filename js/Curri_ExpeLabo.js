$(document).ready(function() {
    $('#form_CurriExLa').bootstrapValidator({
	
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
	
        fields: {
            Nomb_Empre: {
                validators: {
                        stringLength: {
                        min: 2,
			max: 100,
			
                    },
                        notEmpty: {
                        message: 'El nombre de la empresa es obligatorio'
                    }
                }
            },
             pais: {
                validators: {
                     notEmpty: {
                        message: 'Seleccione un país'
                    }
                }
            },
            Acti_Empre: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una actividad'
                    }
                }
            },
	    PuestCargo: {
                validators: {
                     stringLength: {
                        min: 3,
			max: 50,
                    },
                    notEmpty: {
                        message: 'El nombre exacto del puesto o cargo desempeñado es obligatorio'
                    }
                }
            },
            Categoria: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una categoria'
                    }
                }
            },
            Puesto: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione un puesto'
                    }
                }
            },
	    Descrip_Funcio: {
                validators: {
		    stringLength: {
                        min: 10,
			max: 255,
                    },
                    notEmpty: {
                        message: 'La descripción de las funciones en el puesto o cargo desempeñado es obligatoria'
                    }
                }
            },
            Fech_Ini: {
                validators: {
                    notEmpty: {
                        message: 'La fecha de inicio es obligatoria'
                    }
                }
            },
             Fech_Fin: {
                validators: {
                    notEmpty: {
                        message: 'La fecha de finalización es obligatoria'
                    }
                }
            }
	}
        });
});
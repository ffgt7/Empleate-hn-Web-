// JavaScript Document
$(document).ready(function (){
			$('#frmRestablecer').bootstrapValidator({

						// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
						feedbackIcons: {
							//valid: 'glyphicon glyphicon-ok',
							//invalid: 'glyphicon glyphicon-remove',
							//validating: 'glyphicon glyphicon-refresh'
						},

						fields: {
							email: {
									validators: {
										stringLength: {
											min: 2,
											max: 30,
										},
										notEmpty: {
											message: 'El correo es nesesario para comenzar el proceso de recuperacion de contraseña.'
										}
									}
								}

							}
				});
        });

// JavaScript Document
$(document).ready(function (){
			$('#formLogin').bootstrapValidator({

						// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
						feedbackIcons: {
							//valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},

						fields: {
							login: {
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
								password: {
									validators: {
										stringLength: {
											min: 8,
											max: 50,
										},
										notEmpty: {
											message: 'La contraseña es obligatoria'
										}
									}
								},

							}
				});
        });

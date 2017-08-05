$(document).ready(function (){
			$('#form_Habilidades').bootstrapValidator({

						// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
				
						fields: {
							aplicacion_Habi: {
									validators: {
										notEmpty: {
											message: 'El campo habilidad es obligatorio.'
										}
									}
								},
								aplicacion: {
								    validators: {
										notEmpty: {
											message: 'El campo aplicación es obligatorio.'
										}
									}
								},
								nivel: {
									validators: {
										notEmpty: {
											message: 'El campo nivel es obligatorio.'
										}
									}
								}
							
							}
				});
        });
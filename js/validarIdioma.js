// JavaScript Document
$(document).ready(function (){
			$('#form_CurriIdioma').bootstrapValidator({

						// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
				
						fields: {
							idioma: {
									validators: {
										notEmpty: {
											message: 'El campo idioma es obligatorio.'
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
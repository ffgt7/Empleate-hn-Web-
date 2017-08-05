// JavaScript Document
$(document).ready(function (){
			$('#form_CurriCursos').bootstrapValidator({

						// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
				
						fields: {
							NombreCurso: {
									validators: {
										stringLength: {
											min: 3,
											max: 50,
										},
										notEmpty: {
											message: 'El nombre del curso es obligatorio.'
										}
									}
								},
								NombreEmpresa: {
									validators: {
										stringLength: {
											min: 8,
											max: 70,
										},
										notEmpty: {
											message: 'El nombre de la institución es obligatorio.'
										}
									}
								},
								pais: {
									validators: {
										notEmpty: {
											message: 'El país es obligatorio.'
										}
									}
								},
								Fech_Ini: {
									validators: {
										stringLength: {
											min: 8,
											max: 70,
										},
										notEmpty: {
											message: 'La fecha de inicio del curso es obligatoria.'
										}
									}
								},
								Fech_Fin: {
									validators: {
										stringLength: {
											min: 8,
											max: 70,
										},
										notEmpty: {
											message: 'La fecha de fin del curso es obligatoria.'
										}
									}
								}
							
							}
				});
        });
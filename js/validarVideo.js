// JavaScript Document
$(document).ready(function (){
			$('#formVideo').bootstrapValidator({

						// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},

						fields: {
							cate: {
									validators: {
										stringLength: {
											min: 12,
											max: 4,
										},
										notEmpty: {
											message: 'La categoria  es obligatorio'
										},
										
									}
								},
								titulo: {
									validators: {
										stringLength: {
											min: 8,
											max: 200,
										},
										notEmpty: {
											message: 'El tìtulo es obligatoria'
										}
									}
								},
								link: {
									validators: {
										stringLength: {
											min: 8,
											max: 300,
										},
										notEmpty: {
											message: 'El link es obligatoria'
										}
									}
								},
								descripcion: {
									validators: {
										stringLength: {
											min: 8,
											max: 1000,
										},
										notEmpty: {
											message: 'La descripciòn del video es obligatoria'
										}
									}
								},
							}
				});
        });

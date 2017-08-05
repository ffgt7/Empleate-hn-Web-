// JavaScript Document
$(document).ready(function (){
			$('#formLogin').bootstrapValidator({

						// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
						feedbackIcons: {
							//valid: 'glyphicon glyphicon-ok',
							//invalid: 'glyphicon glyphicon-remove',
							//validating: 'glyphicon glyphicon-refresh'
						},

						fields: {
              password1: {
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
             password2: {
                 validators: {
                     stringLength: {
                         min: 8,
                     },
  		    identical: {
                         field: 'password1',
                         message: 'La contraseña y su confirmación no son los mismos.'
                     },
                     notEmpty: {
                         message: 'Repita su contraseña'
                     }
                 }
             }

							}
				});
        });

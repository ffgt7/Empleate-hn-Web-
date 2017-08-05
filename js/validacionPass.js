$(document).ready(function() {
  $('#formPass').bootstrapValidator({

      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          pass: {
              validators: {
                      stringLength: {
                      min: 2,
                      max: 32,
                  },
                      notEmpty: {
                      message: 'Ingresar la contraseña actual es obligatorio'
                  }
              }
          }
        }
    });
});

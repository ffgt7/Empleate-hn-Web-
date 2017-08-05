// JavaScript Document
$(document).ready(function() {
    $('#form_CurriDig').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            avatar: {
                validators: {
                    notEmpty: {
                        message: 'Por favor seleccione un archivo.'
                    },
                    file: {
                        extension: 'docx,doc,pdf',
                        type: 'application/docx,application/doc,application/pdf',
                        maxSize: 3145728,   // 3072 * 1024
                        message: 'El archivo seleccionado no es valido.'
                    }
                }
            }
        }
    });
});
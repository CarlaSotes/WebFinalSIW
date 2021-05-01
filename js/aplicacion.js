/**
 * Cuando esté lista la página, utilizar el dropzone
 */
jQuery(document).ready(function($){
    // Configurar las opciones de subida
    Dropzone.options.myDrop = {
        uploadMultiple: true,       // permitir múltiple subida de archivos
        maxFileSize: 2,             // permitir un archovo máximo de 2MB
        acceptedFiles: 'image/*'    // permitir subir todo tipo de imágenes ( y solo imágenes)

    }
    init: function init(){
        this.on('error', function(){
            // mensaje de error
            swal("¡Error!", "Error al subir archivo", "error");
        });

    }
});
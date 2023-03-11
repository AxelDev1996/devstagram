import Dropzone from 'dropzone';
Dropzone.autoDiscover = false;


const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Subi Aca Tu Imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false
});

dropzone.on('sending', function(file, xhr, formData) {
    console.log(file);
});

dropzone.on('success', function(file, respuesta) {
    console.log(respuesta);
});

dropzone.on('error', function(file, message) {
    console.log(message);
});

dropzone.on('removedfile', function(file, message) {
    console.log('Archivo Eliminado');
});

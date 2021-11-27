function toastErrorNotification(message){
    toastr.error(message,'Error', {
        "newestOnTop": true,
        "progressBar": true,
        "showEasing": "swing",
    });
}

function toastSuccessNotification(message){
    toastr.success(message,'Success', {
        "newestOnTop": true,
        "progressBar": true,
        "showEasing": "swing",
    });
}

function toastInfoNotification(message){
    toastr.info(message,'Info', {
        "newestOnTop": true,
        "progressBar": true,
        "showEasing": "swing",
    });
}
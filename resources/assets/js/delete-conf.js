$('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#confirm').modal()
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
});

$('#confirm').on('shown.bs.modal', function () {
  $('#modal-close').focus();
});
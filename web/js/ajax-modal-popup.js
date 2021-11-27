$(function(){
    $(document).on('click', '.showModalButton', function(){
        triggerModal($(this));        
    });
    $(document).on('click', '#close-modal', function(){
        $(`#main-modal`).hide();
    });
});

function triggerModal(e)
{
    let modal = '#main-modal';
    if ($(modal).hasClass('in')) {
        $(modal).find('#modalContent')
                .load(e.attr('value'));
        document.getElementById('main-modalmodalHeader')
                .innerHTML = '<h4>' + e.attr('title') + '</h4>' +
            '        <button type="button" id="close-modal" class="close" data-dismiss="modal" aria-label="Close">\n' +
            '          <span aria-hidden="true">&times;</span>\n' +
            '        </button>';
    } else {
        $(modal).show()
                .find('#modalContent')
                .load(e.attr('value'));
        document.getElementById('main-modalmodalHeader')
                .innerHTML = '<h4>' + e.attr('title') + '</h4>' +
            '        <button type="button" id="close-modal" class="close" data-dismiss="modal" aria-label="Close">\n' +
            '          <span aria-hidden="true">&times;</span>\n' +
            '        </button>';
    }
}
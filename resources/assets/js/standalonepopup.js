$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '90%',
        height: '80%'
    });

});
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    $('#' + requestingField).val(filePath);
    $('#img-' + requestingField).attr('src',$('#base_img_url').val()+filePath);
    $('#full_img_url').val($('#base_img_url').val()+filePath);
    $('.crop-modal-' + requestingField).show();
    $('.remove-image-' + requestingField).show();
}

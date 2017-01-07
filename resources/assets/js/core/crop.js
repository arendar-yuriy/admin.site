

var Crop = {
    init: function(){
        $('.crop_modal').on('click',function(){
            var href = $(this).data('href');
            var image = $(this).data('image');
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: Main.getLangLink('/crop/view'),
                data:{id:id,href:href,image:image},
                dataType: "html",
                success: function(html){
                    $('#modal_crop').find('.modal-body').html(html);
                }
            });

        });
    }
};

$(document).ready(function(){
    Crop.init();
});
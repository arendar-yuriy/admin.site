/**
 * Created by yura on 15.11.15.
 */
var Main = {
    init:function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input[type=text]').on('click',function(){
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });

        $('input[type=password]').on('click',function(){
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });

        $('textarea').on('click',function(){
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });

        $('select').on('click',function(){
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });

        $('.form-control-feedback').each(function(){
            $(this).hide();
        });

        $(".control-primary").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-primary-600 text-primary-800'
        });

        $('.select').select2({
            minimumResultsForSearch: "-1"
        });
    },
    formSubmit:function(form){
        $(form).find(".ckeditor").each(function() {
            var editorName = $(this).attr("id");
            $(this).val(CKEDITOR.instances[editorName].getData());
        });

        $(form).find('button[type=submit]').attr( "disabled", "disabled" );
        var url = form.action;
        $.ajax({
            type: "POST",
            url: url,
            data: $(form).serialize(),
            dataType: "json",
            success: function(data){
                console.log(data);
                Main.actionData(data,form);
            }
        });

        return false;
    },
    showNotifyMessage: function(title,text,type,simbol,className){
        if(!type)
            type='success';

        new PNotify({
            title: title,
            text: text,
            icon: simbol,
            type: type,
            addclass:className
        });
    },
    showValidationMessage: function(data,form){

        $('input[type=text]').each(function () {
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });

        $('input[type=password]').each(function () {
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });

        $('textarea').each(function(){
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });

        $(form).find('button[type=submit]').removeAttr("disabled", "disabled");
        $.each(data,function(i,value){
            var input = $('#'+i);
            var el = $('#'+i+'-error');
            input.closest('.form-group').addClass('has-error').addClass('has-feedback');
            $('#'+i+'-error-icon').show();
            el.html(value);
        });
    },
    actionData: function(data,form){
        if(typeof data['redirect'] != 'undefined'){
            $('.modified').each(function(){
                $(this).removeClass('modified');
            });
            if(data['redirect']=='')
                window.location.reload();
            else
                window.location = data['redirect'];
        }else{
            if(typeof data['message'] != 'undefined')
                Main.showNotifyMessage(data['title'],data['message'],data['icon'],data['class']);
            else
                Main.showValidationMessage(data,form);
        }
    },
    getLangLink:  function(uri){
        var lang = $('html').attr('lang');
        if(lang)
            return '/'+lang+uri;
        else
            return uri;
    },
    hideModal: function(){
        bootbox.hideAll();
    }

};

$(document).ready(function(){
    Main.init();
});

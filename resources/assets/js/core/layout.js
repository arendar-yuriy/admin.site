$(document).ready(function(){

    // инициализация чекбокса в виде переключателя

    if (Array.prototype.forEach) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
    else {
        var elems = document.querySelectorAll('.switchery');
        for (var i = 0; i < elems.length; i++) {
            var switchery = new Switchery(elems[i]);
        }
    }

    // изменение языка редактируемого контента

    $('.change-lang-form').on('click',function(){
        var lang = $(this).data('lang');
        $.ajax({
            type: "POST",
            url: '/'+lang+'/language-form',
            data: {language:lang},
            dataType: "json",
            success: function(data){
                Main.actionData(data);
            }
        });
    });

    // функционал тегов контента

    $('.select-multiple-tags').select2({
        tags: true,
        ajax: {
            url: Main.getLangLink('/tags/search'),
            type: "POST",
            processResults: function (data) {
                return {
                    results: data,
                    pagination: {
                        more: false
                    }
                };
            }
        },
        createTag: function (tag) {
            return {
                id: tag.term,
                text: tag.term,
                tag: true
            };
        }
    }).on('select2:select', function (evt) {
        if(evt.params.data.tag == false) {
            return;
        }

        var select2Element = $(this);

        $.ajax({
            type: "POST",
            url: Main.getLangLink('/tags/new'),
            data:  { name: evt.params.data.text },
            dataType: "json",
            success: function(data){
                if(data){
                    $('<option value="' + data.id + '">' + data.text + '</option>').appendTo(select2Element);

                    // Replace the tag name in the current selection with the new persisted ID
                    var selection = select2Element.val();
                    var index = selection.indexOf(data.text);

                    if (index !== -1) {
                        selection[index] = data.id.toString();
                    }

                    select2Element.val(selection).trigger('change');
                }

            }
        });
    });

    $('.select-multiple-keywords').select2({
        tags: true,
        ajax: {
            url: Main.getLangLink('/tags/keywords'),
            type: "POST",
            processResults: function (data) {
                console.log(data);
                return {
                    results: data,
                    pagination: {
                        more: false
                    }
                };
            }
        },
        createTag: function (tag) {
            return {
                id: tag.term,
                text: tag.term,
                tag: true
            };
        }
    }).on('select2:select', function (evt) {
        if(evt.params.data.tag == false) {
            return;
        }


        var select2Element = $(this);

        $.ajax({
            type: "POST",
            url: Main.getLangLink('/tags/new'),
            data:  { name: evt.params.data.text },
            dataType: "json",
            success: function(data){
                if(data){

                }

            }
        });
    });

    // инициализация дерева структуры
    if(typeof $(".tree-default").html() !== 'undefined'){
        $(".tree-default").fancytree({
            init: function(event, data) {
                $('.has-tooltip .fancytree-title').tooltip();
            },
            click: function(event, data) {
                var node = data.node;
                if(typeof (node.data.href) !== 'undefined')
                 window.location.href = node.data.href;
            },
        });
    }

    // datepicker init
    $('.daterange-single').daterangepicker({
        singleDatePicker: true
    });

    $('.switchery-primary').each(function(){
        var switchery = new Switchery(this, { color: '#2196F3' });
    });

    $('[data-popup="lightbox"]').fancybox({
        padding: 3
    });

    $.fn.editable.defaults.highlight = false;

    // Output template
    $.fn.editableform.template = '<form class="editableform">' +
        '<div class="control-group">' +
        '<div class="editable-input"></div> <div class="editable-buttons"></div>' +
        '<div class="editable-error-block"></div>' +
        '</div> ' +
        '</form>'

    // Set popup mode as default
    $.fn.editable.defaults.mode = 'popup';

    // Buttons
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-primary btn-icon editable-submit"><i class="icon-check"></i></button>' +
        '<button type="button" class="btn btn-default btn-icon editable-cancel"><i class="icon-x"></i></button>';




    // Demo settings
    // ------------------------------

    // Toggle editable state
    var toggleState = document.querySelector('.enabled-editable');

    if(toggleState !== null){
        var toggleStateInit = new Switchery(toggleState);
        toggleState.onchange = function() {
            if(toggleState.checked) {
                $('.editable').editable('enable');
            }
            else {
                $('.editable').editable('disable');
            }
        };
    }

});

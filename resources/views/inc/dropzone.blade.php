<form action="{{ route("image_upload",['type'=>$controller]) }}" class="dropzone" id="dropzoneImages">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <input type="hidden" name="id" value="{{ $content->id }}">
    <input type="hidden" name="max_position" value="">
    <input type="hidden" name="controller" value="{{ $controller }}">
</form>

<form style="margin-top: 30px;" class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route($controller.'_image', ['id'=>$content->id]) }}">

    <div class="row sortable-panel">
        <div class="col-md-12" id="imagesBlock">

        </div>

    </div>

    {!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}

    <div class="text-right" id="buttonSave" >
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }} <i class="icon-arrow-right14 position-right"></i></button>
    </div>
</form>

<script>
    function checkEmptyList(){
        var i = 0;
        $('input[name=check_image]').each(function(){
            i++;
        });

        if(i==0)
            $('#buttonSave').hide();
        else
            $('#buttonSave').show();

        return i;
    };

    function getPosition(){
        var i = 1;
        setTimeout(function(){
            $('.position-image-value').each(function(){
                $(this).val(i); i=i+1;
            });
        },1000);
    }


    $(document).ready(function(){
        checkEmptyList();

        $(".sortable-panel").sortable({
            connectWith: '.panel-sortable',
            items: '.panel',
            helper: 'original',
            cursor: 'move',
            revert: 100,
            containment: '.content-wrapper',
            forceHelperSize: true,
            placeholder: 'sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            start: function(e, ui){
                ui.placeholder.height(ui.item.outerHeight());
            },
            stop: function(e,ui){
                getPosition();
            }
        });
    });
    window.csrfToken = '{{ csrf_token() }}';
    window.dropzonerDeletePath = '{{ route('image_delete',['type'=>$controller,'id'=>$content->id]) }}';


    Dropzone.options.dropzoneImages = {

                uploadMultiple: false,//will not work for multiple uploads
                parallelUploads: 100,
                maxFilesize: 8,
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                acceptedFiles: 'image/*',
                dictDefaultMessage: '{{ trans('app.drop-upload') }} <span>{{ trans('app.or-click') }}</span>',
                //previewTemplate: document.querySelector('#preview-template').innerHTML,
                addRemoveLinks: true,
                dictRemoveFile: '{{ trans('app.delete') }}',
                dictFileTooBig: 'Image is bigger than 8MB',
                sending: function(file, xhr, formData) {
                    console.log(formData.get("id"));
                    formData.append("_token",  window.csrfToken );
                },

                // The setting up of the dropzone
                init:function() {
                    this.on("removedfile", function(file) {
                        $.ajax({
                            type: 'POST',
                            url: window.dropzonerDeletePath,
                            data: {id: file.serverId, _token: window.csrfToken},
                            dataType: 'html',
                            success: function(data){
                                $('input[name=check_image]').each(function(){
                                    if($(this).val()==file.serverId){
                                        $(this).closest('.panel-default').remove();
                                    }
                                });

                                getPosition();

                                checkEmptyList();

                                var rep = JSON.parse(data);
                                if(rep.code == 200)
                                {
                                }

                            }
                        });

                    } );

                    this.on('queuecomplete',function(){
                        getPosition();
                    });

                },
                error: function(file, response) {
                    if(typeof(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                },
                success: function(file,response) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('upload_image_form') }}',
                        data: {
                            image: response.filename,
                            controller: '{{ $controller }}',
                            id_content: {{ $content->id  }} ,
                            _token: window.csrfToken},
                        dataType: 'html',
                        success: function(data){
                            $('#imagesBlock').prepend(data);

                            checkEmptyList();
                        }
                    });

                    file.serverId = response.filename;


                }
            };


</script>
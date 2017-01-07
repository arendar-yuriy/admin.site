<div class="panel panel-default cursor-move">
    <div class="panel-heading">
        <h6 class="panel-title">{{ (!empty($data['alt'] ))?$data['alt']:$data['image']}}</h6>

        <div class="heading-elements">


            <label class="radio-inline radio-left">
                <input type="radio" name="main" value="{{ ((isset($data['id']))?$data['id']:$data['image']) }}" class="styled"
                       @if(!empty($data['main']) && $data['main']==1)
                       checked="checked"
                        @endif
                >
                {{ trans('app.cover') }}
            </label>

            <ul class="icons-list pull-right">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="move"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label class="text-semibold"></label>
            <div class="media no-margin-top">
                <div class="col-md-2">
                    <div class="thumbnail">
                        <div class="thumb">
                            <img src="{{ $data['path'] }}" >
                            <div class="caption-overflow">
                    <span>
                        <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5 remove-image"><i class="icon-cross2"></i></a>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10">
                    {!! Form::hidden('images['.((isset($data['id']))?$data['id']:$data['image']).'][image]', $data['image']) !!}
                    {!! Form::hidden('images['.((isset($data['id']))?$data['id']:$data['image']).'][position]', $data['position'],['class'=>'position-image-value']) !!}
                    {!! Form::hidden('check_image', $data['image']) !!}
                    <label>{{ trans('app.name') }}:</label>
                    {!! Form::text('images['.((isset($data['id']))?$data['id']:$data['image']).'][name]', @$data['name'] ,['class'=>'form-control']) !!}
                    <label>{{ trans('app.description') }}:</label>
                    {!! Form::text('images['.((isset($data['id']))?$data['id']:$data['image']).'][description]', @$data['description']  ,['class'=>'form-control']) !!}
                </div>

            </div>
        </div>
    </div>


</div>

<script>
    $(document).ready(function(){

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

        $('.remove-image').on('click',function(){
            $(this).closest('.panel-default').remove();
            i = checkEmptyList();
            if(i==0){
                $('#buttonSave').show();
            }
            return false;
        });
        $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

        $('.check-cover').on('change',function(){

            if($(this).prop( "checked" )){
                $('.check-cover').each(function(){
                    $(this).prop( "checked", false );
                });
            }
        });
    });
</script>
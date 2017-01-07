<div class="form-group ">
    <label class="control-label col-lg-2 text-semibold">{{ trans('app.published') }}</label>
    <div class="col-lg-10">
        <div class="checkbox checkbox-switchery switchery-sm">
            <label>
                <?php if ($published  === null) $published = true?>
                <input type="checkbox" id="published_switch" class="switchery " @if($published == 1)checked="checked"@endif>
                {!! Form::hidden('published',$published,['id'=>'published']) !!}
            </label>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $('#published_switch').on('change',function(){
            var checked = $(this).prop('checked');

            checked = (checked) ? 1 : 0;

            $('#published').val(checked);
        });
    });
</script>
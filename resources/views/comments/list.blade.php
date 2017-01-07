<div class="panel  border-grey  panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title text-semiold"><i class="icon-bubbles4 position-left"></i> {{ trans('app.comments') }} ({{ $countComments }}) {{ $dataContent->name }} </h5>

    </div>

    <div class="panel-body">

        {!! $commentsList !!}


        <div id="comment-reply">

        </div>

    </div>
</div>


<script>
    $(document).ready(function(){
        $('.edit-link').on('click',function(){
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: '{{ route('comments_form_edit') }}',
                data: {id:id,type:'{{ Route::current()->parameter('type') }}'},
                dataType: "html",
                success: function(data){
                    $('#comment-reply').html(data);
                }
            });
        });

        $('.reply-link').on('click',function(){
            var id = $(this).data('id');
            var content_id = {{ $content_id }};
            $.ajax({
                type: "GET",
                url: '{{ route('comments_form_add') }}',
                data: {parent_id:id,content_id:content_id,type:'{{ Route::current()->parameter('type')  }}'},
                dataType: "html",
                success: function(data){
                    $('#comment-reply').html(data);
                }
            });
        });
    });
</script>
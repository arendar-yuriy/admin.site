<script type="text/javascript" src="/js/app.js"></script>

<script src="/js/elfinder/js/elfinder.min.js" type="text/javascript" charset="utf-8" ></script>

<script src="/js/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8" ></script>

<script>
    $(document).ready(function(){
        // show message
        {!! @$onLoad !!}

       $(".control-info").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-info-600 text-info-800'
        });
    });
</script>


<div class="page-header">

    <div class="breadcrumb-line">
        @if(Route::current()!==null)
            @if(Breadcrumbs::exists(Route::current()->getName()))
             {!! Breadcrumbs::render(Route::current()->getName()) !!}
            @endif
        @endif
    </div>
</div>
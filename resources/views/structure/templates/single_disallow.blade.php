<li class="dd-item dd3-item" data-id="{id}">
    <div class="dd-handle dd3-handle">Drag</div>
    <div class="dd3-content">
        <a href="{link}" >{name} </a> {level} | <span class="label bg-primary-300">{icon}</span>
        <span class="edit-block-structure pull-right">
            <span class="checkbox checkbox-switchery switchery-xs active-structure">
                <input type="checkbox" readonly class="switchery-primary " {cheked}>
            </span>
            @if($edit)
                <a href="#" data-id="{id}" class="alert-danger remove-button-category "><i class="icon-bin"></i></a>
            @endif
        </span>

    </div>
</li>
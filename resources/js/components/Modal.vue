<template>
    <div :id="id" class="modal fade" tabindex="-1" role="dialog">
        <div :class="'modal-dialog ' + size" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary" style="color:white">
                    <h5 class="modal-title">
                        <slot name="titulo" ></slot>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="contenido"></slot>
                </div>
                <div class="modal-footer">
                    <slot name="botones"></slot>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props:[
        'size',
        'id'
    ]
    
}
</script>
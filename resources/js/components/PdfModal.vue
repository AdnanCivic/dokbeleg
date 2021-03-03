<template>
  <div class="modal bd-example-modal-lg fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <slot name="modal-content"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
    name: 'pdf-modal',
    methods: {
        
    },
}

</script>

<style>
.modal-content {
  height: 95vh;
  
}

</style>
<div class="modal fade" id="modal-image-view">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          ×
        </button>
        <h4 class="modal-title">{{ trans('uploadManager::uploadManager.image_preview') }}</h4>
      </div>
      <div class="modal-body">
        <img id="preview-image" src="x" class="img-responsive">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          {{ trans('uploadManager::uploadManager.cancel') }}
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-file-upload">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="{{ route('uploadManager::upload.file') }}"
            class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="folder" value="{{ $folder }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            ×
          </button>
          <h4 class="modal-title">{{ trans('uploadManager::uploadManager.upload_new_file') }}</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="file" class="col-sm-3 control-label">
              {{ trans('uploadManager::uploadManager.file') }}
            </label>
            <div class="col-sm-8">
              <input type="file" id="file" name="file">
            </div>
          </div>
          <div class="form-group">
            <label for="file_name" class="col-sm-3 control-label">
              {{ trans('uploadManager::uploadManager.optional_filename') }}
            </label>
            <div class="col-sm-4">
              <input type="text" id="file_name" name="file_name"
                     class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            {{ trans('uploadManager::uploadManager.cancel') }}
          </button>
          <button type="submit" class="btn btn-primary">
            {{ trans('uploadManager::uploadManager.upload_file') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

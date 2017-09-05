<div class="modal fade" id="modal-folder-create">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="{{ route('uploadManager::upload.folder') }}"
            class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="folder" value="{{ $folder }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            ×
          </button>
          <h4 class="modal-title">{{ trans('uploadManager::uploadManager.create_new_folder') }}</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="new_folder_name" class="col-sm-3 control-label">
              {{ trans('uploadManager::uploadManager.folder_name') }}
            </label>
            <div class="col-sm-8">
              <input type="text" id="new_folder_name" name="new_folder"
                     class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            {{ trans('uploadManager::uploadManager.cancel') }}
          </button>
          <button type="submit" class="btn btn-primary">
            {{ trans('uploadManager::uploadManager.create_folder') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

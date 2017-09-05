@extends('uploadManager::layout.master')

@section('content')
  <div class="container-fluid">

    {{-- Top Bar --}}
    <div class="row page-title-row">
      <div class="col-md-6">
        <h3 class="pull-left">{{ trans('uploadManager::uploadManager.uploads') }}  </h3>
        <div class="pull-left">
          <ul class="breadcrumb">
            @foreach ($breadcrumbs as $path => $disp)
            <li><a href="{{ route('uploadManager::upload.manager') }}?folder={{ $path }}">{{ $disp }}</a></li>
            @endforeach
            <li class="active">{{ $folderName }}</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 text-right">
        <button
           type="button"
           class="btn btn-success btn-md"
           data-toggle="modal"
           data-target="#modal-folder-create"
           id="button_to_create_new_directory"
        >
           <i class="fa fa-plus-circle"></i> {{ trans('uploadManager::uploadManager.new_folder') }}
        </button>
        <button
              type="button"
              class="btn btn-primary btn-md"
              data-toggle="modal"
              data-target="#modal-file-upload"
              id="button_to_upload_file"
        >
            <i class="fa fa-upload"></i> {{ trans('uploadManager::uploadManager.upload') }}
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">

        @include('core::partials.errors')
        @include('core::partials.success')

        <table id="uploads-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>{{ trans('uploadManager::uploadManager.name') }}</th>
              <th>{{ trans('uploadManager::uploadManager.type') }}</th>
              <th>{{ trans('uploadManager::uploadManager.date') }}</th>
              <th>{{ trans('uploadManager::uploadManager.size') }}</th>
              <th data-sortable="false">{{ trans('uploadManager::uploadManager.actions') }}</th>
            </tr>
          </thead>
          <tbody>
             @include('uploadManager::upload.partials.folders')
             @include('uploadManager::upload.partials.files')
          </tbody>
        </table>

      </div>
    </div>
  </div>

 @include('uploadManager::upload.partials.modals')

@stop

@section('scripts')
  <script>

    // Confirm file delete
    function delete_file(name) {
      $("#delete-file-name1").html(name);
      $("#delete-file-name2").val(name);
      $("#modal-file-delete").modal("show");
    }

    // Confirm folder delete
    function delete_folder(name) {
      $("#delete-folder-name1").html(name);
      $("#delete-folder-name2").val(name);
      $("#modal-folder-delete").modal("show");
    }

    // Preview image
    function preview_image(path) {
      $("#preview-image").attr("src", path);
      $("#modal-image-view").modal("show");
    }

    // Startup code
    $(function() {
      $("#uploads-table").DataTable();
    });
  </script>
@stop

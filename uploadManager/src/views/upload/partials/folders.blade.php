{{-- The Subfolders --}}
@foreach ($subfolders as $path => $name)
  <tr>
    <td>
        <a href="{{ route('uploadManager::upload.manager') }}?folder={{ $path }}">
        <i class="fa fa-folder fa-lg fa-fw"></i>
        {{ $name }}
      </a>
    </td>
    <td>{{ trans('uploadManager::uploadManager.folder') }}</td>
    <td>-</td>
    <td>-</td>
    <td>
        <button
           id="delete_button_for_{{$name}}_folder"
           type="button" class="btn btn-xs btn-danger"
           onclick="delete_folder('{{ $name }}')">
        <i class="fa fa-times-circle fa-lg"></i>
        {{ trans('uploadManager::uploadManager.delete') }}
      </button>
    </td>
  </tr>
@endforeach

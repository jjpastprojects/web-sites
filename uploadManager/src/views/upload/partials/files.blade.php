{{-- The Files --}}
@foreach ($files as $file)
  <tr>
    <td>
      <a href="{{ $file['webPath'] }}">
        @if (is_image($file['mimeType']))
          <i class="fa fa-file-image-o fa-lg fa-fw"></i>
        @else
          <i class="fa fa-file-o fa-lg fa-fw"></i>
        @endif
        {{ $file['name'] }}
      </a>
    </td>
    <td>{{ $file['mimeType'] or 'Unknown' }}</td>
    <td>{{ $file['modified']->format('j-M-y g:ia') }}</td>
    <td>{{ human_filesize($file['size']) }}</td>
    <td>
      <button type="button" class="btn btn-xs btn-danger"
           id="delete_button_for_{{$file['name']}}_file"
           onclick="delete_file('{{ $file['name'] }}')">
        <i class="fa fa-times-circle fa-lg"></i>
        {{ trans('uploadManager::uploadManager.delete') }}
      </button>
      @if (is_image($file['mimeType']))
        <button type="button" class="btn btn-xs btn-success"
                onclick="preview_image('{{ $file['webPath'] }}')"
                id="delete_button_for_{{$file['name']}}_file">
          <i class="fa fa-eye fa-lg"></i>
          {{ trans('uploadManager::uploadManager.preview') }}
        </button>
      @endif
    </td>
  </tr>
@endforeach

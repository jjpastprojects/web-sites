<div class="form-group">
    <div class="col-md-9">
    <input type="text" class="form-control" name="title" value="{{ $post['title'] }}">
    </div>
</div>

<div class="form-group">
    <div class="col-md-9">
        <textarea rows=5  class="form-control" name="description"> {{ $post['description'] }}</textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-md-9">
        <textarea class="editor" name="body">{{ $post['body'] }}</textarea>
    </div>
</div>

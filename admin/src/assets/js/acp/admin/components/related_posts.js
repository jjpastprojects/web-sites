var relatedPosts = Vue.extend({
  template: `
    <div class="form-group">
        <div class="col-md-9">
        <label class="control-label">{{ trans('admin::posts.title') }}</label>
        <input type="text" class="form-control" name="title">
        </div>
    </div>
  `
});

Vue.component('related-posts', relatedPosts);

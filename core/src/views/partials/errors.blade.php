@if(count($errors->all()))
<div class="row">
<ul class="alert alert-warning col-md-4 col-md-push-4">
@foreach($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

@if(session('error'))
<div class="row">
<ul class="alert alert-warning col-md-4 col-md-push-4">
 <li>{{ session('error') }}</li>
</ul>
</div>
@endif

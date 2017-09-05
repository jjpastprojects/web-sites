@foreach($post->relateds as $p)
<li>{{ $p->title }}</li>
@endforeach

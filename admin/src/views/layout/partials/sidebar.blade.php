<ul class="nav nav-sidebar" id="sidebar">
    @foreach(config('admin.links') as $li)
        <li><a  onlick="setActiveClass()" href="{{ $li[1]? route($li[0], eval('return '.$li[1].';')): route($li[0]) }}">{{ $li[2] }}</a></li>
    @endforeach
</ul>

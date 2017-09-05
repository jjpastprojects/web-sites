<div class="row">
    <h1>{{ $file['name'] }}</h1>
    <div class="desc">
        <p>{{ $file['description'] }}</p>
    </div>
    <ul>
        @foreach($file['links'] as $link)
            <li><a href="{{ $link }}">{{ $link }}</a></li>
        @endforeach
    </ul>
</div>

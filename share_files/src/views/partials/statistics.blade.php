@foreach($statistics as $key => $arr)

    @if(count($arr) > 2 )
        <h4 class="h4">{{ $key }}</h4>
        @foreach($arr as $k => $v)
            <button class="btn btn-default btn-sm"  @click="addFilter('{{ $key }}', '{{ $k }}')">{{ $k }} <span>( {{ $v }} )</span></button>
        @endforeach
    @endif

@endforeach

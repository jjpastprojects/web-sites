<select name="{{$i}}" id="{{$i}}">
          {{$j=0}}
         @foreach($values as $value)
            @if($j++ == $i )
             <option value="{{ $value }}" selected="selected">{{ $value }}</option>
            @else
             <option value="{{ $value }}">{{ $value }}</option>
            @endif
         @endforeach
</select>


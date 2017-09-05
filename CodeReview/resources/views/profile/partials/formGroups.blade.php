@if($min == $max)
    @for($i=0;$i< $min; $i++)
        @include('profile.partials.formGroup')
    @endfor
@else
        @if($min == 0)
                @include('profile.partials.formGroup', ['i' => 0])
        @else
            @for($i=0;$i<$min; $i++)
                @include('profile.partials.formGroup', ['i' => $i])
            @endfor
        @endif
@endif




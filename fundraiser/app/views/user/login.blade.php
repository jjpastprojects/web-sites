@extends("layout")
@section("content")
    {{ 
            Form::open([
                "route" => "user/login",
                "autocomplete" => "off"
            ])    
    }}
        {{ Form::label("userid","UserID") }}
        {{ Form::text("userid",Input::old("userid"),[
                "placeholder" => "newuserid"
            ]) }}
        {{ Form::label("password","Password")}}
        {{ Form::password("password",[
            "placeholder" => "*********"    
        ])  }}
         
        @if ($error=$errors->first("password"))
            <div class="error">
                {{$error}}
            </div>
        @endif
        {{ Form::submit("login")}}
    {{ Form::close()}}    
@stop
@section("footer")
    @parent
    <script src="//polyfill.io"></script>
@stop
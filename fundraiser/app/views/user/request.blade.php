@extends("layout")
@section("content")
<div class="forgotpassword">
    <h2>Specify your email address</h2>
    {{
        Form::open([
            "route" => "user/request",
            "autocomplete" => "on"
        ])
    }}
        {{ Form::label("email","Email")}}
        
        {{
            Form::email("email",Input::get("email"),[
                "required"=>""
            ])
        }}
        {{ Form::submit("reset")}}
    {{  Form::close()}}
</div>    
@stop
@section("footer")
    @parent
    <script src="//polyfill.io"></script>
@stop
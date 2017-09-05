@extends("layout")
@section("content")
<div class="resetpassword">
    {{ Form::open([
        "url" => URL::route("user/reset").$token,
        "autocomplete" => "off"
    ])}}
        @if ($error =$errors->first("token"))
            <div class="error">
                {{$error}}
            </div>
        @endif
        <div class="row">
        {{ Form::label("email","Email")}}
        {{ Form::email("email",Input::get("email"),[
            "placeholder" => "john@fundraiser.com"
        ])}}
        
        @if ($error=$errors->first('email'))
            <div class="error">
                {{$error}}
            </div>
        @endif
        
        </div>
        <div class="row">
        {{ Form::label("password","Password")}}
        {{ Form::password("password",[
            
        ]) }}
        
        @if ($error=$errors->first('password'))
            <div class="error">
                {{$error}}
            </div>
        @endif
        </div>
        <div class="row">
        {{ Form::label("password_confirmation","Confirm")}}
        {{ Form::password("password_confirmation",[
            
        ]) }}
        
        @if ($error=$errors->first('password_confirmation'))
            <div class="error">
                {{$error}}
            </div>
        @endif
        </div>
        {{ Form::submit("reset") }}
    {{ Form::close() }}
</div>    
@stop
@section("footer")
    @parent
    <script src="//polyfill.io"></script>
@stop
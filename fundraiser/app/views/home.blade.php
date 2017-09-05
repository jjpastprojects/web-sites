@extends("layout")
@section("content")

<div class="login">
    
    {{ 
        Form::open([
            "route" => "user/login",
            "autocomplete" => "off"
        ])    
    }}
    <div class="title">
        <span>Already have an account?</span>
    </div>    
    <div class="row"> 
        {{ Form::label("userid","Fundraiser ID") }}
        {{ Form::text("userid",Input::old("userid"),[
                
                "type" => "email",
                "required"=>""
            ]) }}        
    </div>
    <div class="row"> 
        {{ Form::label("email","Email") }}
        {{ Form::email("email",Input::old("email"),[
                
                "required"=>""
            ]) }}        
    </div>
    <div class="row"> 
        {{ Form::label("password","Login Password") }}
        {{ Form::password("password",[                
                "required"=>""
            ]) }}        
    </div>
    <div class="row right" > 
        <a href="{{ URL::route('user/request')}}">Forgot</a> fundraiser ID or password?
    </div>
    @if ($error=$errors->first("password"))
    <div class="row error ">
        {{$error}}
    </div>
    @endif
        
    <div class="row center" > 
        {{ Form::submit("Login")}}
    </div>
    {{ Form::close()}}
    
</div>

<div class="signup">
     {{ 
        Form::open([
            "route" => "user/register",
            "autocomplete" => "off"
        ])    
    }}
    <div class="title">
        <span>Sign Up to be a Seller!</span>
    </div>    
    <div class="row"> 
        {{ Form::label("userid","Fundraiser ID") }}
        {{ Form::text("userid",Input::old("userid"),[                
                "type" => "email",
                "required"=>""
            ]) }}
    </div>
     <div class="row"> 
        {{ Form::label("email","Email") }}
        {{ Form::email("email",Input::old("email"),[
                
                "required"=>""
            ]) }}        
    </div>
    <div class="row"> 
        {{ Form::label("password","Password") }}
        {{ Form::password("password",[
                
                "required"=>""
            ]) }}        
    </div>
    <div class="row"> 
        {{ Form::label("password","Confirm Password") }}
        {{ Form::password("password",[
                
                "required"=>""
            ]) }}        
    </div>
    
    <div class="row"> 
       {{ Form::button("Look up Your ID")}}
    </div>
   
    
    <div class="error row">
       @foreach($signup_errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
    
        
    <div class="row center" > 
        {{ Form::submit("Signup")}}
    </div>
    {{ Form::close()}}
</div>
@stop
@section("footer")
    @parent
    <script src="//polyfill.io"></script>
@stop
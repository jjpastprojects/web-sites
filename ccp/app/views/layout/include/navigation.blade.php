<nav class="navbar navbar-default  ">
  <div class="container-fluid">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
	  </button>
	</div>
	<div class="collapse navbar-collapse" id="collapse">
        <ul class="nav  navbar-nav nav-responsive <?php if(Session::get('locale') == 'ar') echo 'navbar-right'; else echo 'navbar-left'; ?>">
	        <li><a href="{{ URL::route('home') }}">{{ Lang::get('general.home') }}</a></li>
	        <li><a href="{{ URL::route('info') }}">{{ Lang::get('general.info') }}</a></li>
	    </ul>

            <ul class="nav  navbar-nav nav-responsive  <?php if(Session::get('locale') == 'ar') echo 'navbar-left'; else echo 'navbar-right'; ?>">
	        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{  Lang::get('general.lang')  }} <b class="caret"></b></a>
    			<ul class="dropdown-menu">
		    			<li><a href="{{ URL::route('lang_chooser') }}?locale=en">{{ Lang::get('lang.en') }}</a></li>
				    	<li><a href="{{ URL::route('lang_chooser') }}?locale=fr">{{ Lang::get('lang.fr') }}</a></li>
				    	<li><a href="{{ URL::route('lang_chooser') }}?locale=ar">{{ Lang::get('lang.ar') }}</a></li>
	    		</ul>
    		</li>
	    </ul>

	 </div>
   </div>
</nav>

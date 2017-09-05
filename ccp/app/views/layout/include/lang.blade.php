<nav class="navbar navbar-default">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#lang">
	      <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
		</button>
	</div>			    
	<div class="collapse navbar-collapse" id="lang">
    	<ul class="nav navbar-nav">
    		<li>
    			<ul>
		    			<li><a href="{{ URL::route('lang_chooser') }}?locale=en">{{ Lang::get('lang.en') }}</a></li>
				    	<li><a href="{{ URL::route('lang_chooser') }}?locale=fr">{{ Lang::get('lang.fr') }}</a></li>
				    	<li><a href="{{ URL::route('lang_chooser') }}?locale=ar">{{ Lang::get('lang.ar') }}</a></li>
	    		</ul>
    		</li>
		 </ul>
	</div>
</nav>
<nav class="navbar navbar-default">
        <div class="container-fluid">
                <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">{{ Lang::get('nav.site-name') }}</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                                <li><a href="/">{{ Lang::get('nav.home') }}</a></li>

                        </ul>


                                              <ul class="nav navbar-nav navbar-right">
                                @if (Auth::guest())
                                        <li><a href="/auth/login">{{ Lang::get('nav.login') }} </a></li>
                                        <li><a href="/auth/register">{{ Lang::get('nav.register') }} </a></li>
                                @else
                                        <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                        <li><a href="/profile/set">{{ trans('general.set_new_variable')}} </a></li>
                                                        <li><a href="/profile/undefinedVariables">{{ trans('general.show_undefined_variable')}} </a></li>
                                                        <li><a href="/profile">{{ trans('general.profile')}} </a></li>
                                                        <li><a href="/auth/logout">{{ trans('general.Logout') }}</a></li>
                                                </ul>
                                        </li>
                                @endif

                        </ul>


                          <ul class="nav navbar-nav navbar-right">
                                @if (Auth::guest())
                                @else
                                        <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('site.page') }} <span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                        <li><a href="/pages">{{ trans('general.new')}} </a></li>
                                                        <li><a href="/pages?isReaded=true">{{ trans('general.readed')}} </a></li>
                                                        <li><a href="/pages?isSaved=true">{{ trans('general.saved')}} </a></li>
                                                        <li><a href="/pages?inTrash=true">{{ trans('general.inTrash')}} </a></li>
                                                </ul>
                                        </li>
                                @endif

                        </ul>



                </div>
        </div>
</nav>

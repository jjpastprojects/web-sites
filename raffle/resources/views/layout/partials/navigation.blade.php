<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route('raffle.index') }}">Raffle Events</a>
            </li>
            <li>
                <a href="{{ route('raffle.create') }}">Make Raffle Event</a>
            </li>
            <li>
                <a href="{{ route('raffle.ongoing') }}">My Ongoing Raffles</a>
            </li>
            <li>
                <a href="{{ route('raffle.completed') }}">My Completed Raffles</a>
            </li>
        </ul>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
        </div>
        <!--/.navbar-collapse -->
    </div>
</nav>

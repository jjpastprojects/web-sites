        <footer class="footer">
                <div class="container">
                        <a href="{{ URL::route('terms') }}">{{ Lang::get('general.terms') }}</a>
                        <a href="{{ URL::route('about_me') }}">{{ Lang::get('general.about_me') }}</a>
                        <a href="{{ URL::route('faq') }}">{{ Lang::get('general.faq') }}</a>
                        <a href="{{ URL::route('contact_me') }}">{{ Lang::get('general.contact_me') }}</a>
                        <div>{{ Lang::get('general.copyright') }}</div>
                </div>
        </footer>
        {{ HTML::script('js/jquery-latest.min.js') }}
        {{ HTML::script('bootstrap/js/bootstrap.min.js') }}
        {{ HTML::script('js/steps.js') }}
    </body>
</html>

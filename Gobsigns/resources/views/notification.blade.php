@if (Session::has('success'))
    <script>
    	new PNotify({ 'styling' : 'bootstrap3','title' : 'Success', 'type' : 'success', 'text' : "{!! Session::get('success') !!}" });
    </script>
@endif

@if (Session::has('errors'))
    <script>
        new PNotify({ 'styling' : 'bootstrap3','title' : 'Error', 'type' : 'error', 'text' : "{!! Session::get('errors')->First() !!}" });
    </script>
@endif

@if (Session::has('status'))
    <script>
        new PNotify({ 'styling' : 'bootstrap3','title' : 'Success', 'type' : 'success', 'text' : "{!! Session::get('status') !!}" });
    </script>
@endif
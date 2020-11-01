@if(Session::has('msg_success'))
	<p class="alert alert-success" style="margin-top: 10px;">{{ Session::get('msg_success') }}</p>
@endif

@if(Session::has('msg_update'))
	<p class="alert alert-warning" style="margin-top: 10px;">{{ Session::get('msg_update') }}</p>
@endif

@if(Session::has('msg_delete'))
	<p class="alert alert-danger" style="margin-top: 10px;">{{ Session::get('msg_delete') }}</p>
@endif
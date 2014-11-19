@extends((( Auth::user()->type==="admin") ? 'layouts.admin' : 'layouts.user' ))

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            @yield('tablecontent')
        </table>
    </div>
@endsection
@section('scripts')
	<script>
		$(document).ready(function() {
		    $('#dataTables-example').dataTable();
		});
	</script>
@endsection
@extends((( Auth::user()->type!=="member") ? 'layouts.admin' : 'layouts.user'))

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            @yield('tablecontent')
        </table>
    </div>
    @yield('otherContent')
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
		    $('#dataTables-example').dataTable();
		});
	</script>
@endsection
@extends((( Auth::user()->type!=="member") ? 'layouts.admin' : 'layouts.user'))

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id='index'>
            @yield('tablecontent')
        </table>
    </div>
    @yield('otherContent')
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
		    $('#index').dataTable({
                "pageLength": 50,
                dom: 'TC<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "{{asset("/swf/copy_csv_xls_pdf.swf")}}",
                    "aButtons": [ "csv"]
                }
            });
		});
	</script>
    @yield('otherScripts')
@endsection
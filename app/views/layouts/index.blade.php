
@if(Auth::user()->type!="admin")
    @extends('layouts.user')
@else
    @extends('layouts.admin')

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            @yield('tablecontent')
        </table>
    </div>
@endsection

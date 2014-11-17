@if({Auth::user()->type==="admin"})
    @extends(layouts.admin)
@else
    @extends(layouts.user)
@endif

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            @yield('tablecontent')
        </table>
    </div>
@endsection

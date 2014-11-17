@if({Auth::user()->type==="admin"})
    @extends(layouts.admin)
@else
    @extends(layouts.user)
@endif

@section('content')
    @yield('panelContent')
@endsection

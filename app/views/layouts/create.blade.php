@extends((( Auth::user()->type==="admin") ? 'layouts.admin' : 'layouts.user' ))

@section('content')
    @yield('panelContent')
@endsection

@extends((( Auth::user()->type!=="member") ? 'layouts.admin' : 'layouts.user' ))

@section('content')
    @yield('panelContent')
@endsection

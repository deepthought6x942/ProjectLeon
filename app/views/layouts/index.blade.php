@extends((( Auth::user()->type!=="member") ? 'layouts.admin' : 'layouts.user'))

@section('content')
    <div class="table-responsive">
        @yield('table')
    </div>
    @yield('otherContent')
@endsection

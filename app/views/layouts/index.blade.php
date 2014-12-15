@extends((( Auth::user()->type!=="member") ? 'layouts.admin' : 'layouts.user'))

@section('content')
    @yield('otherContent')
    @if($table==="N/A")
        @yield('noneFound')
    @else
        <div class="table-responsive">
            @yield('table')
        </div>
    @endif
@endsection
@section('scripts')
  @if($table!=="N/A")
    {{str_replace("\\/","/",$table->script())}}
  @endif
@stop
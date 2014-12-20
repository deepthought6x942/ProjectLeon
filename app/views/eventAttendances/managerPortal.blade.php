@extends('layouts.admin')
@section('header') Event Attendance Manager
@stop
@section('content')
    @if($projectsTable!=="N/A")
        <div class="table-responsive">
            <h2> Events and Projects </h2>
            {{$projectsTable->setOptions(['pageLength'=> 5, "dom"=>'TC<"clear">lfrtip',
                                      'tableTools' => array(
                                            "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                            "aButtons" => [[
                                                "sExtends"=> "csv",
                                                "sButtonText"=>"Export All Columns",
                                                "mColumns"=>[ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                            ],
                                            [
                                                "sExtends"=>"csv",
                                                "sButtonText"=>"Export Visible columns",
                                                "mColumns"=> "visible"
                                            ]]
                                  )])->render()}}
        </div>
    @else
        <h1>There are no Projects or Events</h1>
        <p> You can create one here: {{link_to_route('projects.create')}} </p>
    @endif
@endsection

@section('scripts')
    @if($projectsTable!=="N/A")
        {{str_replace("\\/","/",$projectsTable->script())}}
    @endif
@endsection


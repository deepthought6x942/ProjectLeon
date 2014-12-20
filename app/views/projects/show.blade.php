@extends('layouts.default')

@section('header')
    Projects
@stop
@section('content')
    <div class="col-lg-8">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default" id="panel1">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Project Details
                        <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne"></a>
                    </h4>

                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                {{ Form::model($project, array('method'=>'PUT', 'route' => array('projects.update', $project->id))) }}
                                <tbody>
                                <tr>
                                    <td>{{ Form::label('name', 'Name: ')}}(<span>*</span>):</td>
                                    <td>{{ Form::text('name')}} </td>
                                    <td>{{ $errors->first('name') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('start_date', 'Start Date: ')}} (<span>*</span>):</td>
                                    <td>{{ Form::text('start_date')}}</td>
                                    <td>{{ $errors->first('start_date') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('end_date', 'End Date: ')}} (<span>*</span>):</td>
                                    <td>{{ Form::text('end_date')}}</td>
                                    <td>{{ $errors->first('end_date') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('type', 'Type: ')}} </td>
                                    <td>{{ Form::select('type', $types)}}</td>
                                    @if(Auth::user()->type!=='member')
                                        <td>{{Form::text('Other', "Input Other",array('id' => 'Other', 'disabled'))}}</td>
                                    @endif
                                    <td>{{ $errors->first('type') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('description', 'Description: ')}}</td>
                                    <td>{{ Form::text('description')}}</td>
                                    <td>{{ $errors->first('description') }}</td>
                                </tr>
                                <tr>
                                    <td>{{Form::submit('Edit Event/Project')}}{{Form::close ()}}
                                    <td>
                                </tr>

                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <br>

            @if($project->eventAttendance->count()>0)
                <div class="panel panel-default" id="panel2">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo" class="collapsed">
                                Event Attendance:
                            </a>
                        </h4>
                    </div>
                    <!-- /.panel-heading -->
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="table-responsive">
                                {{$eatable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.panel -->
            @endif
            <br>
            @if(Auth::user()->type=='treasurer')
                @if($project->monetaryDonations->count()>0)
                    <div class="panel panel-default" id="panel3">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-target="#collapseThree" href="#collapseThree"
                                   class="collapsed">
                                    Monetary Donations:
                                </a>
                            </h4>
                        </div>

                        <!-- /.panel-heading -->

      <div id="collapseThree" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="table-responsive">
            {{$mdtable->setOptions(['pageLength'=> 50, "dom"=>'TC<"clear">lfrtip', 
                          'tableTools' => array(
                                    "sRowSelect" =>"multi",
                                    "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                    "aButtons" => [[
                                        "sExtends"=> "csv",
                                        "sButtonText"=>"Export All Columns",
                                        "mColumns"=>[ 1, 2, 3, 4, 5, 6]
                                    ],
                                    [
                                        "sExtends"=>"csv",
                                        "sButtonText"=>"Export Visible columns",
                                        "mColumns"=> "visible"
                                    ],
                                    "select_all", "select_none"]
                      )])->render()}}
          </div>
          <!-- /.table-responsive -->
        </div>

        @endif
                <!--/.panel -->
        @endif
    </div>
@stop

@section('scripts')
    @if($mdtable!=="N/A")
        {{str_replace("\\/","/",$mdtable->script())}}
    @endif
    @if($eatable!=="N/A")
        {{str_replace("\\/","/",$eatable->script())}}
    @endif
    <script type=text/javascript>
        jQuery(document).ready(function ($) {
            $('#type').change(function () {
                if ($(this).val() == 'Other') {
                    document.getElementById('Other').disabled = false;
                } else {
                    document.getElementById('Other').disabled = true;
                }

            });
        });
    </script>
@stop
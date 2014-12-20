@extends('layouts.default')

@section('header') {{$user->first. " ". $user->last}}
@stop
@section('content')
    <div class="col-lg-8">
        <div class="panel-group" id="accordion">
            {{Form::model($user, array('method'=>'PUT', 'route' => array('users.update', $user->id)))}}
            <div class="panel panel-default" id="panel1">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne" class="collapsed">
                            Edit Information:
                        </a>
                    </h4>

                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>{{ Form::label('first', 'First Name')}}(<span>*</span>):</td>
                                    <td>{{ Form::text('first')}}</td>
                                    <td style="color:red;">{{ $errors->first('first') }}</td>

                                    <td>{{ Form::label('last', 'Last Name')}}(<span>*</span>):</td>
                                    <td>{{ Form::text('last')}}</td>
                                    <td style="color:red;">{{ $errors->first('last') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('email', 'E-mail')}}(<span>*</span>):</td>
                                    <td>{{ Form::text('email')}}</td>
                                    <td style="color:red;">{{ $errors->first('email') }}</td>

                                    <td>{{ Form::label('address1', 'Address One: ')}}</td>
                                    <td>{{ Form::text('address1')}}</td>
                                    <td>{{ $errors->first('address1') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('address2', 'Address Two: ')}}</td>
                                    <td>{{ Form::text('address2')}}</td>
                                    <td>{{ $errors->first('address2') }}</td>

                                    <td>{{ Form::label('city', 'City: ')}}</td>
                                    <td>{{ Form::text('city')}}</td>
                                    <td>{{ $errors->first('city') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('state', 'State: ')}}</td>
                                    <td>{{ Form::text('state')}}</td>
                                    <td>{{ $errors->first('state') }}</td>

                                    <td>{{ Form::label('country', 'Country: ')}}</td>
                                    <td>{{ Form::text('country')}}</td>
                                    <td>{{ $errors->first('country') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('zipcode', 'Zipcode: ')}}</td>
                                    <td>{{ Form::text('zipcode')}}</td>
                                    <td>{{ $errors->first('zipcode') }}</td>

                                    <td>{{ Form::label('contact_preference', 'Contact Preference:') }}</td>
                                    <td>{{ Form::select('contact_preference', ['E-mail'=>'E-mail', 'Phone'=>'Phone']) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('telephone', 'Phone Number: ')}}</td>
                                    <td>{{ Form::text('telephone')}}</td>
                                    <td>{{ $errors->first('telephone') }}</td>

                                    <center>
                                        @if(Auth::user()->type!=='member')
                                            @if(Auth::user()->type==='treasurer')

                                                <td>{{Form::label('type', 'Type: ')}}</td>
                                                <td>{{ Form::select('type', ['administrator'=>'administrator', 'treasurer'=>'treasurer','member'=>'member'])}}</td>
                                                <td> {{ $errors->first('type') }}</td>
                                </tr>
                                @else
                                    @if($user->type==='treasurer')

                                        <td><strong>Type</strong></td>
                                        <td>{{ $user->type}}</td>
                                        </tr>

                                    @else

                                        <td>{{Form::label('type', 'Type: ')}}</td>
                                        <td>{{ Form::select('type', ['administrator'=>'administrator','member'=>'member'])}}</td>
                                        <td> {{ $errors->first('type') }}</td>
                                        </tr>

                                    @endif
                                @endif
                                @endif


                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{Form::submit('Edit User')}}{{Form::close ()}}</td>
                                </tr>
                                </center>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($adtable!=='N/A')
            <div class="panel panel-default" id="panel2">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo" class="collapsed">
                            Auction Donations:
                        </a>
                    </h4>
                </div>
                <!-- /.panel-heading -->
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="table-responsive">
                            {{$adtable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.panel -->
        @endif
        @if(Auth::user()->type!=='member')
            @if($user->eventAttendance->count()>0)
                <div class="panel panel-default" id="panel3">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapseThree" href="#collapseThree"
                               class="collapsed">
                                Event Attendance:
                            </a>
                        </h4>
                    </div>
                    <!-- /.panel-heading -->
                    <div id="collapseThree" class="panel-collapse collapse">
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
                        <!-- Remind me to check if they want users to be able to view their own monetary donations-->
                @if($user->monetaryDonations->count()>0 && Auth::user()->type==="treasurer")
                    <div class="panel panel-default" id="panel4">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-target="#collapseFour" href="#collapseFour"
                                   class="collapsed">
                                    Monetary Donations:
                                </a>
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    {{$mdtable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                @endif
            @endif
    </div>


@stop
@section('scripts')
    @if($adtable!=="N/A")
        {{str_replace("\\/","/",$adtable->script())}}
    @endif
    @if($mdtable!=="N/A")
        {{str_replace("\\/","/",$mdtable->script())}}
    @endif
    @if($eatable!=="N/A")
        {{str_replace("\\/","/",$eatable->script())}}
    @endif
@stop
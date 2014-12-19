@extends('layouts.default')
@section('header')Auction Donations @stop   
@section('content')
  {{Form::open(['route'=>'auctionDonations.changeYear'])}}
  {{Form::label("year", "Select Year: ")}}
  {{Form::select("year",$years, $year)}}
  {{Form::submit("Select")}}
  {{Form::close()}}
  @if(Session::has('auc_donate_success'))
    Donation Saved
  @endif
  @if(Session::has('auc_update_success'))
    Update Succesful
  @endif
  @if($table!=="N/A")
  
  <h2> Donations </h2>
  <div class="table-responsive">
    {{ Form::open(['route'=>'auctionDonations.updateBatch']) }}
    {{$table->setOptions(['pageLength'=> 100, "dom"=>'TC<"clear">lfrtip', 
                            'tableTools' => array(
                                    "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                    "aButtons" => [[
                                        "sExtends"=> "csv",
                                        "sButtonText"=>"Export All Columns",
                                        "mColumns"=>[ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                    ],
                                    [
                                        "sExtends"=>"csv",
                                        "sButtonText"=>"Export Visible columns",
                                        "mColumns"=> "visible"
                                    ]]
                        )])->render()}}
  </div>
  <h3>Edit Selected Donations</h3>
  {{ Form::label('field', 'Select the Field')}}
    {{ Form::select('field', $batchFields, 'status')}}
    {{ Form::label('changeTo', 'Select the new Value')}}
    {{ Form::select('changeTo', $statuses)}}
    {{ Form::label('other', 'Value if other selected')}}
    {{ Form::text('other')}}
    {{ $errors->first('other') }}
    {{Form::submit('Submit')}}
    {{Form::close()}}
    <br>
    @endif
@stop
@section('scripts')
  @if($table!=="N/A")
    {{str_replace("\\/","/",$table->script())}}
  @endif
  <script type=text/javascript>
jQuery(document).ready(function($){
  $('#field').change(function() {
      var options = '';
      if($(this).val() == 'status') {
          options= '<?php
            $string='';
            foreach ($statuses as $status => $name) {
              $string=$string.'<option value="'.$status.'">'.$name.'</option>';
            }
            echo $string;
          ?>';
      }
      else if($(this).val() == 'category') {
          options= '<?php
            $string='';
            foreach ($categories as $cat => $name) {
              $string=$string.'<option value="'.$cat.'">'.$name.'</option>';
            }
            echo $string;
          ?>';
      }else if($(this).val() == 'location') {
          options= '<?php
            $string='';
            foreach ($locations as $loc => $name) {
              $string=$string.'<option value="'.$loc.'">'.$name.'</option>';
            }
            echo $string;
          ?>';
      }
      $('#changeTo').html(options);
    });
});
</script>


@stop
@section('otherContent')
  
@stop
@section('noneFound')
  <h1>There are no Donations for this year</h1>
  <p> You can create one {{link_to_route('auctionDonations.admin_create', 'here')}} </p>


@endsection
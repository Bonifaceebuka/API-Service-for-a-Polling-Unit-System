@extends('layouts.app')
@section('title')
Polling Unit Result
@endsection
@section('extra-styles')
<style>
	table.table td a,
	table.table td a:hover{
		color: white;
	}
</style>
@endsection
@section('content')
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Polling Unit Result</h2>
				</div>
				<div class="col-sm-6">
					<a href="{{route('index')}}" class="btn btn-success"> 
						<span>Polling Units</span></a>
				</div>
			</div>
        </div>
        @if(count($results)>0)
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Polling Unit Name</th>
					<th>Party</th>
					<th>Party Score</th>					
				</tr>
			</thead>
			<tbody id="data_container">
				
					@foreach($results as $result)
						<tr>
							<td>
                                @if($result->polling_unit->polling_unit_name == '')
                                    NULL
                                @else
                                {{$result->polling_unit->polling_unit_name}}
                                @endif
                            </td>
							<td>
								{{$result->party_abbreviation}}
							</td>
							<td>
								{{$result->party_score}}
							</td>
						</tr>
					@endforeach
			</tbody>
        </table>
        @else
            <h4 class="text-center">No Results Found For This Polling Unit</h4>
        @endif
		<p>&nbsp;</p>
</div>
@endsection
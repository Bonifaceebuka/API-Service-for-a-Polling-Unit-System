@extends('layouts.app')
@section('title')
Polling Units In a L.G.A
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
					<h2>Polling Units In a L.G.A</h2>
				</div>
				<div class="col-sm-6">
                        <a href="{{route('index')}}" class="btn btn-success"> 
                                <span>Polling Units</span></a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>L.G.A Name</th>
					<th>State Name</th>
					<th>Total Polling Units</th>					
				</tr>
			</thead>
			<tbody id="data_container">
				@if(count($lgas)>0)
					@foreach($lgas as $lga)
						<tr>
							<td>
                                {{$lga->lga_name}}
							<td>
								@if(isset($lga->state->state_name))
								{{$lga->state->state_name}}
								@else
								N/A
								@endif
							</td>
							<td>
								{{$lga->polling_unit_count}}
							</td>
						</tr>
					@endforeach
				@else

				@endif
			</tbody>
		</table>
		{{$lgas->links()}}
		<p>&nbsp;</p>
</div>
@endsection
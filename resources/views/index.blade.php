@extends('layouts.app')
@section('title')
Election Polling Units
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
					<h2>Election Polling Units</h2>
				</div>
				<div class="col-sm-6">
					<a href="{{route('new_result')}}" class="btn btn-success"><i class="fa fa-plus"></i> 
						<span>Add Result</span></a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Polling Unit Name</th>
					<th>Ward</th>
					<th>L.G.A</th>
					<th>Actions</th>					
				</tr>
			</thead>
			<tbody id="data_container">
				@if(count($polling_units)>0)
					@foreach($polling_units as $polling_unit)
						<tr>
							<td>@if($polling_unit->polling_unit_name == '')
                                    NULL
                                @else
                                {{$polling_unit->polling_unit_name}}
                                @endif</td>
							<td>
								@if(isset($polling_unit->ward->ward_name))
								{{$polling_unit->ward->ward_name}}
								@else
								N/A
								@endif
							</td>
							<td>
								@if(isset($polling_unit->lga->lga_name))
								{{$polling_unit->lga->lga_name}}
								@else
								N/A
								@endif
							</td>
							<td>
								<a href="{{route('polling_unit_results',$polling_unit->uniqueid)}}" class="btn text-white btn-success">
									<span>Check Result</span></a>
							</td>
						</tr>
					@endforeach
				@else

				@endif
			</tbody>
		</table>
		{{$polling_units->links()}}
		<p>&nbsp;</p>
</div>
@endsection
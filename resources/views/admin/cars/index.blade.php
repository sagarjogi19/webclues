<!-- home.blade.php -->
@extends('adminlte::page')
@section('title', 'Webclues - Cars')
@section('content')
<style>
    .error{
        color:red;
    }
</style>
<div class="box">
	<div class="box-header">
		<div class="btn-group pull-right">
                    <a href="{{route('admin.view-map')}}" class="btn btn-primary pull-right">
			<i class="fa fa-fw fa-map "></i>
				<span class="text">View in Map</span>
                    </a> 
			<a href="{{route('admin.cars.create')}}" class="btn btn-primary pull-right" style="margin-right:10px;">
			<i class="fa fa-fw fa-car "></i>
				<span class="text">Add Car</span>
			</a>
		</div>
            

	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="carsdaTatable" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Color</th>
					<th>Make Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>
@endsection

@section('js')
<script>
		$(document).ready(function () {
                   
         
			 $.ajaxSetup({
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
               $('#carsdaTatable').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('/admin/cars') }}',
               columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{data: 'name', name: 'name'},
					{data: 'color', name: 'color'},
					{data: 'make_date', name: 'make_date'},
					{data: 'is_active', name: 'is_active'},
					{data: 'action', name: 'action'},
				],
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [ 0, 5 ] },
					{ "bSearchable": false, "aTargets": [ 0, 5 ] }
				]
            });
		
         });
         </script>
@stop
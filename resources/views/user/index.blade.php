@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="container-fluid">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>User <strong>Profile</strong></h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ route('user.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
						<a href="{{ route('user.trashed') }}" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Restore</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">				
				<thead>
					<tr>
						<th>SL</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
						<th>User Email</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>Age</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $row)
					<tr>
						<td>{{ $loop->iteration}}</td>
						<td>{{ $row->profile?->fname }}</td>
						<td>{{ $row->profile?->lname }}</td>
						<td>{{ $row->username }} </td>
						<td>{{ $row->email }}</td>
						<td>{{ $row->profile?->address }}</td>
						<td>{{ $row->profile?->phone }}</td>
						<td>{{ $row->profile?->age }}</td>
						<td>
                            <form action="{{ route('user.destroy', $row->id) }}" method="POST" class="d-flex">
                                <a href="{{ route('user.edit', $row->id) }}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
                            </form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $users->onEachSide(5)->links() }}
		</div>
	</div>        
</div>

@push('script')
	<script>
		$('body').on('click', '.delete', function(e){
			e.preventDefault(); // prevent form submit
			var form = $(this).parents('form'); 
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					form.submit();
				}
			})
		})
	</script>
	@if(session()->has('message'))	
		<script>
			window.swal.fire({
				position: 'top-end',
				icon: "{{ session('type') }}",
				title: "{{ session('message') }}",
				showConfirmButton: false,
				timer: 1500
			}).then(console.log)
				.catch(console.error);
		</script>
	@endif
@endpush
@endsection
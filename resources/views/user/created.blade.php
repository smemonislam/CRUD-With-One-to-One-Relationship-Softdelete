
@extends('layouts.app')

@section('title', 'New User Profile')

@section('content')
<!-- Add Post -->
<div id="addEmployeeModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="{{ route('user.store') }}" method="POST">
                @csrf
				<div class="modal-header">						
					<h4 class="modal-title">New User Profile</h4>
					<a href="{{ route('user.index') }}" class="btn btn-danger d-flex"><i class="material-icons">&#xE15C;</i> <span>Back</span></a>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>First Name</label>
						<input name="fname" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input name="lname" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input name="username" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input name="email" type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input name="password" type="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea name="address" class="form-control" cols="5" rows="4"></textarea>
					</div>	
					<div class="form-group">
						<label>Phone Number</label>
						<input name="phone" type="text" class="form-control" required>
					</div>	
					<div class="form-group">
						<label>Age</label>
						<input name="age" type="text" class="form-control" required>
					</div>			
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>

@push('script')
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
@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<!-- Edit Modal HTML -->
<div id="editEmployeeModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
			<form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
				<div class="modal-header">						
					<h4 class="modal-title">New User user</h4>
					<a href="{{ route('user.index') }}" class="btn btn-danger d-flex"><i class="material-icons">&#xE15C;</i> <span>Back</span></a>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>First Name</label>
						<input name="fname" type="text" class="form-control" value="{{ $user->profile?->fname }}" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input name="lname" type="text" class="form-control" value="{{ $user->profile?->lname }}" required>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input name="username" type="text" class="form-control" value="{{ $user->username }}" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input name="email" type="email" class="form-control" value="{{ $user->email }}" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input name="password" type="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea name="address" class="form-control" cols="5" rows="4">{{ $user->profile?->address }}</textarea>
					</div>	
					<div class="form-group">
						<label>Phone Number</label>
						<input name="phone" type="text" class="form-control" value="{{ $user->profile?->phone }}" required>
					</div>	
					<div class="form-group">
						<label>Age</label>
						<input name="age" type="text" class="form-control" value="{{ $user->profile?->age }}" required>
					</div>			
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
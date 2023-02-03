
@extends('master')

@section('content')

<div class="card">
	<div class="card-header">Edit Emp</div>
	<div class="card-body">
		<form method="post" action="{{ route('emp.update', $emp->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Emp Name</label>
				<div class="col-sm-10">
					<input type="text" name="emp_name" class="form-control" value="{{ $emp->emp_name }}" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Emp Email</label>
				<div class="col-sm-10">
					<input type="text" name="emp_email" class="form-control" value="{{ $emp->emp_email }}" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Emp Gender</label>
				<div class="col-sm-10">
					<select name="emp_gender" class="form-control">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Emp Image</label>
				<div class="col-sm-10">
					<input type="file" name="emp_image" />
					<br />
					<img src="{{ asset('images/' . $emp->emp_image) }}" width="100" class="img-thumbnail" />
					<input type="hidden" name="hidden_emp_image" value="{{ $emp->emp_image }}" />
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $emp->id }}" />
				<input type="submit" class="btn btn-primary" value="Edit" />
			</div>	
		</form>
	</div>
</div>
<script>
document.getElementsByName('emp_gender')[0].value = "{{ $emp->emp_gender }}";
</script>

@endsection
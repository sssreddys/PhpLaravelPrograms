@extends('master')
@section('content')
<div class="card">
   <div class="card-header">
  <div class="row">
   <div class="col-col-md-6"><b>Employees details</b></div>
   <div class="col-col-md-6">
    <a href="{{route('emp.index')}}" class="btn btn-primary btn-sm float-end">view all</a>
 </div>
 </div>
</div>

<div class ="card-body">
<div class="row mb-3">
  <label class="col-sm-2 col-label-form"><b>Emp Name :</b></label>
  <div class="col-sm-10">
    {{$emp->emp_name}}
  </div>


</div>
<div class="row mb-4">
  <label class="col-sm-2 col-label-form"><b>Emp Gender :</b></label>
  <div class="col-sm-10">
    {{$emp->emp_gender}}
  </div>


</div>
<div class="row mb-4">
  <label class="col-sm-2 col-label-form"><b>Emp Email :</b></label>
  <div class="col-sm-10">
    {{$emp->emp_email}}
  </div>


</div>

<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Emp Image</b></label>
			<div class="col-sm-10">
				<img src="{{ asset('images/' .  $emp->emp_image) }}" width="200" class="img-thumbnail" />
			</div>
</div>




</div>
</div>
@endsection('section')
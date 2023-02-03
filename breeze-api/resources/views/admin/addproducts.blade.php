@extends('admin.admin-layout')
@section('router-outlet')
<div class="card-header py-3 mb-2">
    <div class="row">
        <div class="col col-md-6"><b>Product Products</b></div>

        {{-- <div class="col col-md-6">
            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-end">Add Products</a>
        </div> --}}
    </div>
</div>
<div class="container py-2 mb-2" >
<div class="card"  >
	<div class="card-header">Add Products</div>
	<div class="card-body">
		<form method="post" class="form-inline justify-content-center" action="{{ route('STOREPRODUCTS') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Product Name</label>
				<div class="col-sm-4">
					<input type="text" name="title" class="form-control" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Product Description</label>
				<div class="col-sm-4">
					<input type="text" name="description" class="form-control" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Product Image</label>
				<div class="col-sm-10">
					<input type="file" name="image" />
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Add Products" />
			</div>
		</form>
	</div>
</div>
</div>
@endsection

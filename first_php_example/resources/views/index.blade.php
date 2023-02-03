@extends('master')
@section('content')

@if ($message = Session::get('success'))

<div class="alert alert-success">

     {{ $message }}
</div>
@endif

<div class="card">
      <div class="card-header">
          <div class="row">

               <div class="col col-md-6"> <b>Employees Data</b></div>

               <div class="col col-md-6">

                    <a href="{{ route('emp.create') }}" class="btn btn-success btn-sm float-end">Add New Emp</a>

                </div>

            </div>

        </div>

    <div class="card-body">

          <table class="table table-bordered">

              <tr>

                  <th>Image {{ $i }}</th>

                   <th>Name</th>

                    <th>Email</th>

                     <th>Gender</th>

                     <th>Action</th>
              </tr>
              @if (count($data)>0)
              @foreach($data as $row)
              <tr>
          <td><img src="{{asset('images/' .$row->emp_image)}}" class="rounded-circle img_sm" width="58"/></td>
          <td>{{$row->emp_name}}</td>
          <td>{{$row->emp_email}}</td>
          <td>{{$row->emp_gender}}</td>
          <td>
     <form method="post" action="{{route('emp.destroy',$row->id)}}">
     @csrf
     @method('DELETE')
     <a href="{{ route('emp.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
	 <a href="{{ route('emp.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
     <input type="submit" class="btn btn-danger btn-sm" value="delete"/>


     </form>


          </td>



              
              </tr>
              @endforeach
              @else
              <tr>
        <td colspan="5" class="text-cent">No Data Found</td>
</tr>
@endif
</table>
{!!$data->links()!!}
</div>

</div>

  @endsection
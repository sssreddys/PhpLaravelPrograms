@extends('admin.admin-layout')
@section('router-outlet')

<div class="container bootstrap snippets bootdey">
    <h1 class="text-primary">Edit Profile</h1>
      <hr>
	<div class="row">
      <!-- left column -->
      <form  method="post" action="{{route('updateProfile')}}" class="form-horizontal" enctype="multipart/form-data" role="form">
        @csrf
      <div class="container">
            <div class="row">
                <div class="col-md-4">
               
                <div class="text-center">
              <img src="{{Auth::user()->image?asset('profile_images/'.Auth::user()->image):'https://bootdey.com/img/Content/avatar/avatar7.png'}}" class="avatar img-circle img-thumbnail" alt="avatar">
                <!--  -->
                {{-- <input type="hidden" name="hidden_image" value="{{ Auth::user()->image }}" /> --}}
                <h6>Upload a different photo...</h6>
                
                <input type="file" class="form-control">
                </div>
              </div>
              
            <div class="col-md-8">
            <div class="col-md-9 personal-info">
        
        <h3>Personal info</h3>
        
       
          <div class="form-group">
            <label class="col-lg-3 control-label"> Name:</label>
            <div class="col-lg-8">
              <input class="form-control" name="name" type="text" value="{{Auth::user()->name}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" name="email" type="email" value="{{Auth::user()->email}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Mobile Number:</label>
            <div class="col-lg-8">
              <input class="form-control"name="mobile" type="text" value="{{Auth::user()->mobile}}">
            </div>
          </div>
          
          </div>
          <div class="text-center">
            <label class="col-lg-3 control-label"></label>
            <div class="col-lg-8">
            {{-- <input type="hidden" name="hidden_id" value="{{Auth::user()->id}}" /> --}}
            <input type="submit" class="btn btn-primary" value="Update Profile" />
            </div>
        </div>	
        </div>
      
      
      <!-- edit form column -->
      
          
        </form>
      </div>
  </div>
</div>
<hr>
@endsection

<script type="text/javascript">
      
  $(document).ready(function (e) {
   
     
     $('#image').change(function(){
              
      let reader = new FileReader();
   
      reader.onload = (e) => { 
   
        $('#preview-image-before-upload').attr('src', e.target.result); 
      }
   
      reader.readAsDataURL(this.files[0]); 
     
     });
     
  });
   
  </script>
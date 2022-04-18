<!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Pages</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="card radius-10">
          <div class="card-body">
            <form method="post" action="{{url('/')}}/admin/update_profile" enctype="multipart/form-data">
              @csrf 
              @if (session('success'))
               <div class="alert alert-dismissible fade show py-2 bg-success">
                  <div class="d-flex align-items-center">
                    <div class="fs-3 text-white"><ion-icon name="checkmark-circle-sharp" role="img" class="md hydrated" aria-label="checkmark circle sharp"></ion-icon>
                    </div>
                    <div class="ms-3">
                      <div class="text-white">{{session('success')}}</div>
                    </div>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
               @endif
            <h5 class="mb-3">Edit Profile</h5>
            <div class="mb-4 d-flex flex-column gap-3 align-items-center justify-content-center">
              <div class="user-change-photo shadow">
                @if($user->photo !='')
                <img id="image_preview" src="{{ url('/')}}/uploads/user_profile/{{$user->id}}/{{$user->photo}}" alt="...">
                @else
                 <img id="image_preview" src="{{url('/')}}/assets/images/no-user.jpg" alt="...">
                @endif
              </div>
              <button type="button" class="btn btn-outline-primary btn-sm radius-30 px-4">
                <input type="file" name="profile_image" onchange="preview()" ><ion-icon name="image-sharp"></ion-icon>Change Photo
              </button>
            </div>
            <h5 class="mb-0 mt-4">User Information</h5>
            <hr>
            <div class="row g-3">
              <div class="col-6">
                 <label class="form-label">Username</label>
                 <input type="text" name="username" class="form-control" value="{{$user->username}}" readonly="">
              </div>
              <div class="col-6">
               <label class="form-label">Email address</label>
               <input type="text" name="email" class="form-control" value="{{$user->email}}" readonly="">
             </div>
               <div class="col-6">
                 <label class="form-label">Full Name</label>
                 <input type="text" name="full_name" class="form-control" value="{{$user->full_name}}">
                 @if($errors->has('full_name'))
                  <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
                @endif
             </div>
             <div class="col-6">
                 <label class="form-label">Mobile No.</label>
                 <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}">
                 @if($errors->has('mobile'))
                  <div class="invalid-feedback">{{ $errors->first('mobile') }}</div>
                @endif
             </div>
           </div>

           <h5 class="mb-0 mt-4">Contact Information</h5>
           <hr>
           <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{$user->address}}">
               </div>
               <div class="col-6">
                  <label class="form-label">City</label>
                  <input type="text" name="city" class="form-control" value="{{$user->city}}">
               </div>
               <div class="col-6">
                <label class="form-label">Country</label>
                <input type="text" name="country" class="form-control" value="{{$user->country}}">
              </div>
                <div class="col-6">
                  <label class="form-label">State</label>
                  <input type="text" name="state" class="form-control" value="{{$user->state}}">
              </div>
            </div>
            <div class="text-start mt-3">
              <button type="submit" class="btn btn-primary px-4">Save Changes</button>
            </div>
          </div>
         </form>
        </div>
      </div>
    </div><!--end row-->
  </div>
  <!-- end page content-->
</div>

<script>
  function preview() {
    image_preview.src=URL.createObjectURL(event.target.files[0]);
  }
</script>
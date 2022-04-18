 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/course">Course</a></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <!-- <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
             <li class="breadcrumb-item"><a href="{{url('/')}}/admin/chapter">Chapter</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">Add Course</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-header">
       <!--  <h6 class="mb-0">Chapter Input</h6> -->
      </div>
      <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/course/store" enctype="multipart/form-data">
          @csrf
          <div class="row">

              <div class="col-md-6">
              <label class="form-label">Course Code</label>
              <input class="form-control mb-3" type="text" name="courseCode" placeholder="Course Code" value="{{old('courseCode')}}">
              @if($errors->has('courseCode'))
                <div class="invalid-feedback">{{ $errors->first('courseCode') }}</div>
              @endif
            </div> 

             <div class="col-md-6">
              <label class="form-label">Name</label>
              <input class="form-control mb-3" type="text" name="courseTitle" placeholder="Course Name" value="{{old('courseTitle')}}">
              @if($errors->has('courseTitle'))
                <div class="invalid-feedback">{{ $errors->first('courseTitle') }}</div>
              @endif
            </div>

             <div class="col-md-6">
              <label class="form-label">Price</label>
              <input class="form-control mb-3" type="text" name="price" placeholder="Price" value="{{old('price')}}">
              @if($errors->has('price'))
                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
              @endif
            </div>

            <div class="col-md-12">
              <label class="form-label">Short Description</label>
             <textarea class="form-control" id="shortDescription" placeholder="Enter the Short Description" name="shortDescription" value="{{old('shortDescription')}}"></textarea>
              @if($errors->has('shortDescription'))
                <div class="invalid-feedback">{{ $errors->first('shortDescription') }}</div>
              @endif
            </div>

            <div class="col-md-12">
              <label class="form-label">Description</label>
             <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"  value="{{old('description')}}"></textarea>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>


             <div class="col-md-6">
              <label class="form-label">Status</label>
                <select class="form-select mb-3" name="status" aria-label="Default select example">
                  <option selected="" value="">Select Status</option>
                  <option value="1">Active</option>
                  <option value="0">In-Active</option>
                </select>
                @if($errors->has('status'))
                  <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                @endif
            </div>
            <div class="text-start mt-3">
              <button type="submit" class="btn btn-primary px-4">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end page content-->
</div>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<script>
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'shortDescription' );
</script>
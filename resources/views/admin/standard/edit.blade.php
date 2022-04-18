 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/standard">Standard</a></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <!-- <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/')}}/admin/standard">Standard</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">Edit Standard</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-header">
        <h6 class="mb-0">Standard Input</h6>
      </div>
      <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/standard/update/{{base64_encode($arrdata['standardID'])}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <label class="form-label">Standard Title</label>
              <input class="form-control mb-3" type="text" name="standardName" value="{{$arrdata['standardName']}}" placeholder="Standard Title" >
              @if($errors->has('standardName'))
                <div class="invalid-feedback">{{ $errors->first('standardName') }}</div>
              @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Standard Code</label>
              <input class="form-control mb-3" type="text" name="standardCode" value="{{$arrdata['standardCode']}}" placeholder="Standard Code" >
              @if($errors->has('standardCode'))
                <div class="invalid-feedback">{{ $errors->first('standardCode') }}</div>
              @endif
            </div> 
           
            <div class="col-md-6">
              <label class="form-label">Status</label>
                <select class="form-select mb-3" name="status" aria-label="Default select example">
                  <option selected="" value="">Select Status</option>
                  <option value="1" @if($arrdata['status']==1) selected="" @endif>Active</option>
                  <option value="0" @if($arrdata['status']==0) selected="" @endif>In-Active</option>
                </select>
                @if($errors->has('status'))
                  <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                @endif
            </div>
            <div class="col-md-12">
              <label class="form-label">Description</label>
             <textarea class="form-control" id="description" value="{{$arrdata['description']}}" placeholder="Enter the Description" name="description">{{$arrdata['description']}}</textarea>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
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
CKEDITOR.replace( 'subject' );
</script>
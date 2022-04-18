 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Forms</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
             <li class="breadcrumb-item"><a href="{{url('/')}}/admin/banners">Banners</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Banner</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-header">
        <h6 class="mb-0">Banners Input</h6>
      </div>
      <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/banners/update/{{base64_encode($arrdata['id'])}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <label class="form-label">Category</label>
                <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                  <option selected="" value="">Select Category</option>
                  @foreach($arrCategories as $category)
                  <option value="{{$category['id']}}" @if($category['id']==$arrdata['category_id']) selected="" @endif>{{$category['name']}}</option>
                  @endforeach
                </select>
                @if($errors->has('category_id'))
                  <div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
                @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input class="form-control mb-3" type="text" name="title" value="{{$arrdata['title']}}" placeholder="Title" >
              @if($errors->has('title'))
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
              @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Social Link</label>
              <input class="form-control mb-3" type="text" name="social_link" value="{{$arrdata['social_link']}}" placeholder="Social Link" >
              @if($errors->has('social_link'))
                <div class="invalid-feedback">{{ $errors->first('social_link') }}</div>
              @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Social Name</label>
              <input class="form-control mb-3" type="text" name="social_name" value="{{$arrdata['social_name']}}" placeholder="Social Name" >
              @if($errors->has('social_name'))
                <div class="invalid-feedback">{{ $errors->first('social_name') }}</div>
              @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Social Icon</label>
              <input class="form-control mb-3" type="text" name="social_icon" value="{{$arrdata['social_icon']}}" placeholder="Social Icon" >
              @if($errors->has('social_icon'))
                <div class="invalid-feedback">{{ $errors->first('social_icon') }}</div>
              @endif
            </div>
            
             
            <div class="col-md-6">
              <label class="form-label">Status</label>
                <select class="form-select mb-3" name="status" aria-label="Default select example">
                  <option selected="" value="">Select Status</option>
                  <option value="1" @if($arrdata['status']==1) selected="" @endif>Publish</option>
                  <option value="0" @if($arrdata['status']==0) selected="" @endif>Unpublish</option>
                </select>
                @if($errors->has('status'))
                  <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                @endif
            </div>
             <div class="mb-3">
              <div class="cart-img text-center text-lg-start">
                <img id="image_preview" src="{{ url('/')}}/uploads/banners/{{$arrdata['image']}}" alt="" width="130">
              </div>
              <label for="formFileMultiple" class="form-label">Select Image</label>
              <input class="form-control" type="file" name="image" onchange="preview()">
               @if($errors->has('image'))
                <div class="invalid-feedback">{{ $errors->first('image') }}</div>
              @endif
            </div>
            <div class="col-md-12">
              <label class="form-label">Description</label>
             <textarea class="form-control" id="description" placeholder="Enter the Description" name="description">{{$arrdata['description']}}</textarea>
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
  function preview() {
    image_preview.src=URL.createObjectURL(event.target.files[0]);
  }
</script>
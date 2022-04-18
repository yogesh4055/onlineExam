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
            <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard"><ion-icon name="home-outline"></ion-icon></a>
            </li>
             <li class="breadcrumb-item"><a href="{{url('/')}}/admin/gallery">Gallery</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Gallery</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-header">
        <h6 class="mb-0">Gallery Input</h6>
      </div>
      <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/gallery/store" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <label class="form-label">Gallery Title</label>
              <input class="form-control mb-3" type="text" name="title" placeholder="Gallery Title" >
              @if($errors->has('title'))
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
              @endif
            </div>
             <div class="col-md-6">
              <label class="form-label">Category</label>
                <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                  <option selected="" value="">Select Category</option>
                  @foreach($arrCategories as $category)
                  <option value="{{$category['id']}}">{{$category['name']}}</option>
                  @endforeach
                </select>
                @if($errors->has('category_id'))
                  <div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
                @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Industry</label>
                <select class="form-select mb-3" name="industry_id" aria-label="Default select example">
                  <option selected="" value="">Select Industry</option>
                  @foreach($arrIndustries as $industry)
                  <option value="{{$industry['id']}}">{{$industry['name']}}</option>
                  @endforeach
                </select>
                @if($errors->has('industry_id'))
                  <div class="invalid-feedback">{{ $errors->first('industry_id') }}</div>
                @endif
            </div>
            <div class="col-md-12">
              <label class="form-label">Description</label>
             <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"></textarea>
              @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
              @endif
            </div>
             <div class="col-md-12">
              <label class="form-label">Meta Keyword</label>
              <input class="form-control mb-3" type="text" name="meta_keywords" placeholder="Meta Keyword" >
              @if($errors->has('meta_keywords'))
                <div class="invalid-feedback">{{ $errors->first('meta_keywords') }}</div>
              @endif
            </div>
            <div class="mb-3">
              <label for="formFileMultiple" class="form-label">Select Images</label>
              <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple="">
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
 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/subject">Subject</a></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
          <!--   <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
             <li class="breadcrumb-item"><a href="{{url('/')}}/admin/standard">Subject</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-header">
       <!--  <h6 class="mb-0">Subject Input</h6> -->
      </div>
      <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/subject/store" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <label class="form-label">Subject Code</label>
              <input class="form-control mb-3" type="text" name="subjectCode" value="{{old('subjectCode')}}" placeholder="Subject Code" >
              @if($errors->has('subjectCode'))
                <div class="invalid-feedback">{{ $errors->first('subjectCode') }}</div>
              @endif
            </div>

             <div class="col-md-6">
              <label class="form-label">Subject Title</label>
              <input class="form-control mb-3" type="text" name="subjectName" value="{{old('subjectName')}}"  placeholder="Subject Name" >
              @if($errors->has('subjectName'))
                <div class="invalid-feedback">{{ $errors->first('subjectName') }}</div>
              @endif
            </div>

            <div class="col-md-6">
              <label class="form-label">Standard</label>
                <select class="form-select mb-3" name="standardID" aria-label="Default select example">
                  <option selected="" value="">Select Standard</option>
                  @foreach($arrStandard as $standard)
                  <option value="{{$standard['standardID']}}" {{ old('standardID') == $standard['standardID'] ? "selected" : "" }}>{{$standard['standardName']}}</option>
                  @endforeach
                </select>
                @if($errors->has('standardID'))
                  <div class="invalid-feedback">{{ $errors->first('standardID') }}</div>
                @endif
            </div>



             <div class="col-md-6">
              <label class="form-label">Seo Uri</label>
              <input class="form-control mb-3" type="text" name="seoUri" value="{{old('seoUri')}}" placeholder="seoUri" >
              @if($errors->has('seoUri'))
                <div class="invalid-feedback">{{ $errors->first('seoUri') }}</div>
              @endif
            </div>


              
             <div class="col-md-6">
              <label class="form-label">Status</label>
                <select class="form-select mb-3" name="status" aria-label="Default select example">
                  <option selected="" value="">Select Status</option>
                  <option value="1" {{ old('status') == 1 ? "selected" : "" }}>Active</option>
                  <option value="0" {{ old('status') == 0 ? "selected" : "" }}>In-Active</option>
                </select>
                @if($errors->has('status'))
                  <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                @endif
            </div>

             <div class="col-md-12">
              <label class="form-label">Description</label>
             <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"></textarea>
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
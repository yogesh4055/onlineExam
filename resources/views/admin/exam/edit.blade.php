 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/exam">Exam</a></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <!-- <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/')}}/admin/standard">Standard</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">Edit Exam</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <!-- <div class="card-header">
        <h6 class="mb-0">Exam Input</h6>
      </div> -->
      <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/exam/update/{{base64_encode($arrdata['examId'])}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
           
            <div class="col-md-6">
              <label class="form-label">Exam Code</label>
              <input class="form-control mb-3" type="text" name="examCode" value="{{$arrdata['examCode']}}" placeholder="Exam Code" >
              @if($errors->has('examCode'))
                <div class="invalid-feedback">{{ $errors->first('examCode') }}</div>
              @endif
            </div>

            <div class="col-md-6">
              <label class="form-label">Exam Name</label>
              <input class="form-control mb-3" type="text" name="examName" value="{{$arrdata['examName']}}" placeholder="Exam Name" >
              @if($errors->has('examName'))
                <div class="invalid-feedback">{{ $errors->first('examName') }}</div>
              @endif
            </div>

            <div class="col-md-6">
              <label class="form-label">Exam Price</label>
              <input class="form-control mb-3" type="text" name="examPrice" value="{{$arrdata['examPrice']}}" placeholder="Exam Price" >
              @if($errors->has('examPrice'))
                <div class="invalid-feedback">{{ $errors->first('examPrice') }}</div>
              @endif
            </div>


            <div class="col-md-6">
              <label class="form-label">Exam Time</label>
              <input class="form-control mb-3" type="text" name="examTime" value="{{$arrdata['examTime']}}" placeholder="Exam Time" >
              @if($errors->has('examTime'))
                <div class="invalid-feedback">{{ $errors->first('examTime') }}</div>
              @endif
            </div>


            <div class="col-md-6">
              <label class="form-label">Exam Mark</label>
              <input class="form-control mb-3" type="text" name="examMark" value="{{$arrdata['examMark']}}" placeholder="Exam Mark" >
              @if($errors->has('examMark'))
                <div class="invalid-feedback">{{ $errors->first('examMark') }}</div>
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

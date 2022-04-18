 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/sub-course">Sub Course</a></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <!-- <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
             <li class="breadcrumb-item"><a href="{{url('/')}}/admin/chapter">Chapter</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">Edit Sub Course</li>
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
        <form method="post" action="{{url('/')}}/admin/sub-course/update/{{base64_encode($arrdata['subCourseID'])}}" enctype="multipart/form-data">
          @csrf
          <div class="row">

            <div class="col-md-6">
              <label class="form-label">Standard</label>
                <select class="form-select mb-3" id='courseID' name="courseID" aria-label="Default select example">
                  <option selected="" value="">Select Course</option>
                  @foreach($arrCourseData as $course)
                  <option value="{{$course['courseID']}}" @if($course['courseID']==$arrdata['courseID']) selected="" @endif>{{$course['courseTitle']}}</option>
                  @endforeach
                </select>
                @if($errors->has('courseID'))
                  <div class="invalid-feedback">{{ $errors->first('courseID') }}</div>
                @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Sub Course</label>
              <input class="form-control mb-3" type="text" name="subCourseTitle" value="{{$arrdata['subCourseTitle']}}" placeholder="Sub Course Title" value="{{old('subCourseTitle')}}">
              @if($errors->has('subCourseTitle'))
                <div class="invalid-feedback">{{ $errors->first('subCourseTitle') }}</div>
              @endif
            </div> 
            <div class="table-responsive">
        <table id="DataTable" class="table table-striped table-bordered data-table" style="width:100%">
          <thead>
            <tr>
              <th>
                <input type="checkbox" name="mult_change" id="check-all" value="delete" />
              </th>
              <th width="5%">Code</th>
              <th>Exam</th>
              <th>Price</th>
              <th>Time</th>
              <th>Marks</th>
            </tr>
          </thead>
           <tbody>
            @foreach ($arrExamData as $key => $row)
            <tr>
              <td> 
                @if(in_array($row->examId,$arrdata->arrExamids))
                <input type="checkbox" name="checked_examIds[]" checked="" class="checked_examIds" value="{{ $row->examId }}" />
                @else
                <input type="checkbox" name="checked_examIds[]" class="checked_examIds" value="{{ $row->examId }}" />
                @endif
              </td>
              <td>{{$row->examCode}}</td>
              <td>{{$row->examName}}</td>
              <td>{{$row->examPrice}}</td>
              <td>{{$row->examTime}}</td>
              <td>{{$row->examMark}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
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

$('#check-all').click(function (e) {
  $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
</script>
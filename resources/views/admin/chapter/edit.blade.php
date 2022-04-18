 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/chapter">Chapter</a></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
          <!--   <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/')}}/admin/chapter">Chapter</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">Edit </li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-header">
      
      </div>
      <div class="card-body">
        <form method="post" action="{{url('/')}}/admin/chapter/update/{{base64_encode($arrdata['chapterID'])}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
             <div class="col-md-6">
              <label class="form-label">Chapter Code</label>
              <input class="form-control mb-3" type="text" name="chapterCode" placeholder="Chapter Code" value="{{$arrdata['chapterCode']}}">
              @if($errors->has('chapterCode'))
                <div class="invalid-feedback">{{ $errors->first('chapterCode') }}</div>
              @endif
            </div>

             <div class="col-md-6">
              <label class="form-label">Chapter Name</label>
              <input class="form-control mb-3" type="text" name="chapterName" placeholder="Chapter Name" value="{{$arrdata['chapterName']}}" >
              @if($errors->has('chapterName'))
                <div class="invalid-feedback">{{ $errors->first('chapterName') }}</div>
              @endif
            </div>


              <div class="col-md-6">
              <label class="form-label">Standard</label>
                <select class="form-select mb-3" name="standardID"  id="sel_standard" aria-label="Default select example">
                  <option selected="" value="">Select Standard</option>
                  @foreach($arrStandard as $standard)
                  <option value="{{$standard['standardID']}}" @if($standard['standardID']==$arrdata['standardID']) selected="" @endif>{{$standard['standardName']}}</option>
                  @endforeach
                </select>
                @if($errors->has('standardID'))
                  <div class="invalid-feedback">{{ $errors->first('standardID') }}</div>
                @endif
            </div>

            <div class="col-md-6">
              <label class="form-label">Subject</label>
                <select class="form-select mb-3" name="subjectID "  id="subject_list" aria-label="Default select example">
                  <option selected="" value="">Select subject </option>
                  @foreach($arrSubject as $subject)
                   <option value="{{$subject['subjectID']}}" @if($subject['subjectID']==$arrdata['subjectID']) selected="" @endif>{{$subject['subjectName']}}</option>
                  @endforeach
                </select>
                @if($errors->has('subjectID'))
                  <div class="invalid-feedback">{{ $errors->first('subjectID') }}</div>
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

             <div class="col-md-6">
              <label class="form-label">Seo Uri</label>
              <input class="form-control mb-3" type="text" name="seoUri" placeholder="seoUri" value="{{$arrdata['seoUri']}}">
              @if($errors->has('seoUri'))
                <div class="invalid-feedback">{{ $errors->first('seoUri') }}</div>
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

$(document).ready(function(){

    var baseURL= "{{url('/')}}/";
      // City change
        $('#sel_standard').change(function(){
          var standard = $(this).val();
          $.ajax({
             headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url:baseURL+'admin/getSubject',
              method: 'post',
              data: {standard: standard},
              dataType: 'json',
              success: function(response){
                  // Remove options
                  $('#subject_list').find('option').not(':first').remove();

                  // Add options
                  $.each(response,function(index,data){
                      $('#subject_list').append('<option value="'+data['subjectID']+'">'+data['subjectName']+'</option>');
                  });
              }
          });
      });


  })
  
</script>
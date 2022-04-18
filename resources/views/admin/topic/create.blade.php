 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/topic">Topic</a></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <!-- <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
             <li class="breadcrumb-item"><a href="{{url('/')}}/admin/chapter">Chapter</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">Add Topic</li>
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
        <form method="post" action="{{url('/')}}/admin/topic/store" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <label class="form-label">Standard</label>
                <select class="form-select mb-3" id='sel_standard' name="standard" aria-label="Default select example">
                  <option selected="" value="">Select Standard</option>
                  @foreach($arrStandard as $standard)
                  <option value="{{$standard['standardID']}}">{{$standard['standardName']}}</option>
                  @endforeach
                </select>
                @if($errors->has('standard'))
                  <div class="invalid-feedback">{{ $errors->first('standard') }}</div>
                @endif
            </div>

               <div class="col-md-6">
              <label class="form-label">Subject</label>
                <select class="form-select mb-3" id='subject_list' name="subject" aria-label="Default select example">
                  <option selected="" value="">Select subject </option>
                 
                </select>
                @if($errors->has('subject'))
                  <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
                @endif
            </div>


              <div class="col-md-6">
              <label class="form-label">Chapter</label>
                <select class="form-select mb-3" name="chapter" id="chapter_list" aria-label="Default select example">
                  <option selected="" value="">Select Chapter </option>
                 
                </select>
                @if($errors->has('chapter'))
                  <div class="invalid-feedback">{{ $errors->first('chapter') }}</div>
                @endif
            </div>

              <div class="col-md-6">
              <label class="form-label">Topic Code</label>
              <input class="form-control mb-3" type="text" name="topicCode" placeholder="Topic Code" >
              @if($errors->has('topicCode'))
                <div class="invalid-feedback">{{ $errors->first('topicCode') }}</div>
              @endif
            </div> 


             <div class="col-md-6">
              <label class="form-label">Topic Name</label>
              <input class="form-control mb-3" type="text" name="topicName" placeholder="Topic Name" >
              @if($errors->has('topicName'))
                <div class="invalid-feedback">{{ $errors->first('topicName') }}</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){

              var baseURL= "{{url('/')}}/";
                // City change
                  $('#sel_standard').change(function(){
                    var standard = $(this).val();
                    $.ajax({
                       headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                       // url : "{{ url('getSubject') }}",
                        url:baseURL+'admin/getSubject',
                        method: 'post',
                        data: {standard: standard},
                        dataType: 'json',
                        success: function(response){
                            // Remove options
                            $('#subject_list').find('option').not(':first').remove();
                            $('#chapter_list').find('option').not(':first').remove();

                            // Add options
                            $.each(response,function(index,data){
                                $('#subject_list').append('<option value="'+data['subjectID']+'">'+data['subjectName']+'</option>');
                            });
                        }
                    });
                });


                   $('#subject_list').change(function(){
                    var subject = $(this).val();
                     $.ajax({
                       headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                       // url : "{{ url('getSubject') }}",
                        url:baseURL+'admin/getChapter',
                        method: 'post',
                        data: {subject: subject},
                        dataType: 'json',
                        success: function(response){
                            // Remove options
                            $('#chapter_list').find('option').not(':first').remove();
                            //$('#sel_depart').find('option').not(':first').remove();

                            // Add options
                            $.each(response,function(index,data){
                                $('#chapter_list').append('<option value="'+data['chapterID']+'">'+data['chapterName']+'</option>');
                            });
                        }
                    });
                });

    });
  </script>
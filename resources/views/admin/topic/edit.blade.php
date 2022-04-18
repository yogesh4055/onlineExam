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
        <form method="post" action="{{url('/')}}/admin/topic/update/{{base64_encode($arrdata['topicID'])}}" enctype="multipart/form-data">
          @csrf
          <div class="row">

              <div class="col-md-6">
              <label class="form-label">Standard</label>
                <select class="form-select mb-3" name="standard" id="sel_standard" >
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
                <select class="form-select mb-3" id='subject_list' name="subject" >
                  <option  value="">Select subject </option>
                 
                </select>
                @if($errors->has('subject'))
                  <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
                @endif
            </div>

             <div class="col-md-6">
              <label class="form-label">Chapter</label>
                <select class="form-select mb-3" id="chapter_list" name="chapter" >
                  <option  value="">Select Chapter </option>
                 
                </select>
                @if($errors->has('chapter'))
                  <div class="invalid-feedback">{{ $errors->first('chapter') }}</div>
                @endif
            </div>

             <div class="col-md-6">
              <label class="form-label">Topic Code</label>
              <input class="form-control mb-3" type="text" name="topicCode" placeholder="Topic Code" value="{{$arrdata['topicCode']}}">
              @if($errors->has('topicCode'))
                <div class="invalid-feedback">{{ $errors->first('topicCode') }}</div>
              @endif
            </div> 


            <div class="col-md-6">
              <label class="form-label">Topic Name</label>
              <input class="form-control mb-3" type="text" name="topicName" placeholder="Topic Name" value="{{$arrdata['topicName']}}">
              @if($errors->has('topicName'))
                <div class="invalid-feedback">{{ $errors->first('topicName') }}</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){

               var baseURL  = "<?php echo env('BASE_URL');?>";
               var subjectID = "<?php echo $arrdata['subjectID'];?>";
               var chapterID= "<?php echo $arrdata['chapterID'];?>";
             
              //this calls it on load
              $("select#sel_standard").change(getSubject);
              $("select#subject_list").change(getChapter);

               getSubject();

              function getSubject() {
                var standard = $("select#sel_standard option:selected").attr('value');
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
                          $('#chapter_list').find('option').not(':first').remove();
                          // Add options
                          $.each(response,function(index,data){
                             $('#subject_list').append('<option value="'+data['subjectID']+'">'+data['subjectName']+'</option>');
                          });

                          $("#subject_list option[value='"+subjectID+"']").attr('selected', 'selected');
                          getChapter();
                          
                      }
                  });
                }
               
                //$("#subject_list option[value='"+data_dial_code+"']").prop('selected', true);
               // $("#subject_list option[value='"+subjectID+"']").attr('selected', true);

                function getChapter() {
                 var subject = $("select#subject_list option:selected").attr('value');
                    $.ajax({
                       headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:baseURL+'admin/getChapter',
                        method: 'post',
                        data: {subject: subject},
                        dataType: 'json',
                        success: function(response){
                            $('#chapter_list').find('option').not(':first').remove();
                            $.each(response,function(index,data){
                               $('#chapter_list').append('<option value="'+data['chapterID']+'">'+data['chapterName']+'</option>');
                            });
                             $("#chapter_list option[value="+chapterID+"]").attr('selected', 'selected');
                            
                        }
                    });
                }
    });
  </script>
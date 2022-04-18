 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/question">Question </a></div>
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
        <form method="post" action="{{url('/')}}/admin/question/update/{{base64_encode($arrdata['topicID'])}}" enctype="multipart/form-data">
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
              <label class="form-label">Topic</label>
                <select class="form-select mb-3" name="topic" id="topic_list" aria-label="Default select example">
                  <option selected="" value="">Select Topic </option>
                </select>
                @if($errors->has('topic'))
                  <div class="invalid-feedback">{{ $errors->first('topic') }}</div>
                @endif
            </div>



             <div class="col-md-6">
              <label class="form-label">Question Code</label>
              <input class="form-control mb-3" type="text" name="questionCode" value="{{$arrdata['questionCode']}}" placeholder="Question Code " >
              @if($errors->has('questionCode'))
                <div class="invalid-feedback">{{ $errors->first('questionCode') }}</div>
              @endif
            </div>

             <div class="col-md-6">
              <label class="form-label">Question Type</label> {{$arrdata['option_type']}}
                <select class="form-select mb-3" name="option_type" id="option_type" aria-label="Default select example">
                  <option selected="" value="1" @if($arrdata['option_type']==1) selected="" @endif>With Options </option>
                   <option  value="2" @if($arrdata['option_type']==2) selected="" @endif>No Options </option>
                </select>
            </div>


             <div class="col-md-12">
              <label class="form-label">Question</label> 
             <textarea class="form-control" id="question" placeholder="Enter the Description" name="question" value="{{$arrdata['question']}}">{{$arrdata['question']}}</textarea>
              @if($errors->has('question'))
                <div class="invalid-feedback">{{ $errors->first('question') }}</div>
              @endif
            </div>

            <div class="col-md-12">
              <label class="form-label">Answer A</label>
             <textarea class="form-control" id="answerA" placeholder="Enter the Description" name="answerA" value="{{$arrdata['answerA']}}">{{$arrdata['answerA']}}</textarea>
              @if($errors->has('answerA'))
                <div class="invalid-feedback">{{ $errors->first('answerA') }}</div>
              @endif
            </div>

            <div class="col-md-12" id="answerb">
              <label class="form-label">Answer B</label>
             <textarea class="form-control" id="answerB" placeholder="Enter the Answer B" name="answerB" value="{{$arrdata['answerB']}}">{{$arrdata['answerB']}}</textarea>
              @if($errors->has('answerB'))
                <div class="invalid-feedback">{{ $errors->first('answerB') }}</div>
              @endif
            </div>

            <div class="col-md-12"id="answerc">
              <label class="form-label">Answer C</label>
             <textarea class="form-control" id="answerC" placeholder="Enter the Answer C" name="answerC" value="{{$arrdata['answerC']}}">{{$arrdata['answerC']}}</textarea>
              @if($errors->has('answerC'))
                <div class="invalid-feedback">{{ $errors->first('answerC') }}</div>
              @endif
            </div>

            <div class="col-md-12" id="answerd">
              <label class="form-label">Answer D</label>
             <textarea class="form-control" id="answerD" placeholder="Enter the Answer D" name="answerD" value="{{$arrdata['answerD']}}">{{$arrdata['answerD']}}</textarea>
              @if($errors->has('answerD'))
                <div class="invalid-feedback">{{ $errors->first('answerD') }}</div>
              @endif
            </div>


             <div class="col-md-12">
              <label class="form-label">Answer Hint</label>
             <textarea class="form-control" id="answerHint" placeholder="Enter the Answer D" name="answerHint" value="{{$arrdata['answerHint']}}">{{$arrdata['answerHint']}}</textarea>
              @if($errors->has('answerHint'))
                <div class="invalid-feedback">{{ $errors->first('answerHint') }}</div>
              @endif
            </div> 

             <div class="col-md-6">
              <label class="form-label">Correct Answer</label>
                <select class="form-select mb-3" name="correctAnswer" id="correctAnswer" aria-label="Default select example">
                  <option selected="" value="" >Select Correct Answer</option>
                  <option value="A" @if($arrdata['correctAnswer']=='A') selected="" @endif>A</option>
                  <option value="B" @if($arrdata['correctAnswer']=='B') selected="" @endif>B</option>
                   <option value="C" @if($arrdata['correctAnswer']=='C') selected="" @endif>C</option>
                   <option value="D" @if($arrdata['correctAnswer']=='D') selected="" @endif>D</option>
                </select>
                @if($errors->has('correctAnswer'))
                  <div class="invalid-feedback">{{ $errors->first('correctAnswer') }}</div>
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

<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'question' );
CKEDITOR.replace( 'answerA' );
CKEDITOR.replace( 'answerB' );
CKEDITOR.replace( 'answerC' );
CKEDITOR.replace( 'answerD' );
CKEDITOR.replace( 'answerHint' );
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){
               var option_type = $("select#option_type option:selected").attr('value');

              if(option_type == 2){
                       $('#answerb').hide();
                       $('#answerc').hide();
                       $('#answerd').hide();
                       $("#correctAnswer").prop('disabled',true);
                       $("#correctAnswer option[value=A]").attr('selected', 'selected');
                      }else{
                       $('#answerb').show();
                       $('#answerc').show();
                       $('#answerd').show();
                        $("#correctAnswer").prop('disabled',false);
                      }


               var baseURL  = "<?php echo env('BASE_URL');?>";
               var subjectID = "<?php echo $arrdata['subjectID'];?>";
               var chapterID= "<?php echo $arrdata['chapterID'];?>";
               var topicID= "<?php echo $arrdata['topicID'];?>";
              
              //this calls it on load
              $("select#sel_standard").change(getSubject);
              $("select#subject_list").change(getChapter);
              $("select#chapter_list").change(getTopic);

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
                            getTopic();
                        }
                    });
                }


                function getTopic() {
                 var chapterID = $("select#chapter_list option:selected").attr('value');
                    $.ajax({
                       headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:baseURL+'admin/getTopic',
                        method: 'post',
                        data: {chapterID: chapterID},
                        dataType: 'json',
                        success: function(response){
                            $('#topic_list').find('option').not(':first').remove();
                            $.each(response,function(index,data){
                               $('#topic_list').append('<option value="'+data['topicID']+'">'+data['topicName']+'</option>');
                            });
                             $("#topic_list option[value="+topicID+"]").attr('selected', 'selected');
                            
                        }
                    });
                }

                $('#option_type').change(function(){
                    var option_type = $(this).val();
                      if(option_type == 2){
                       $('#answerb').hide();
                       $('#answerc').hide();
                       $('#answerd').hide();
                       $("#correctAnswer").prop('disabled',true);
                       $("#correctAnswer option[value=A]").attr('selected', 'selected');
                      }else{
                       $('#answerb').show();
                       $('#answerc').show();
                       $('#answerd').show();
                        $("#correctAnswer").prop('disabled',false);
                      }
                    });

    });
  </script>
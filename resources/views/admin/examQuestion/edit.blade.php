 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{url('/')}}/admin/exam-question">Question </a></div>
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
        <form method="post" action="{{url('/')}}/admin/exam-question/update/{{base64_encode($arrdata['topicID'])}}" id="frmSubmit" enctype="multipart/form-data">
          @csrf
          <div class="row">

              <div class="col-md-4">
              <label class="form-label">Exam Name</label>
                <select class="form-select mb-3" id='exam' name="exam" aria-label="Default select example">
                  <option selected="" value="">Select Exam Name</option>
                  @foreach($arrexam as $exam)
                  <option value="{{$exam['examId']}}" @if($exam['examId']==$arrdata['examId']) selected="" @endif>{{$exam['examName']}}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback" id="err_exam"></div>
                @if($errors->has('exam'))
                  <div class="invalid-feedback">{{ $errors->first('exam') }}</div>
                @endif
            </div>

              <div class="col-md-4">
              <label class="form-label"> Total Question</label>
              <input class="form-control mb-3" type="text" name="totalQuestion" value="{{$arrdata['totalQuestion']}}" placeholder=" Total Question " >
              <div class="invalid-feedback" id="err_totalQuestion"></div>
              @if($errors->has('totalQuestion'))
                <div class="invalid-feedback">{{ $errors->first('totalQuestion') }}</div>
              @endif
            </div>

             <div class="col-md-4">
              <label class="form-label">Marks Per Question</label>
              <input class="form-control mb-3" type="text" name="markPerQuestion" value="{{$arrdata['markPerQuestion']}}" placeholder="Marks Per Question " >
               <div class="invalid-feedback" id="err_markPerQuestion"></div>
              @if($errors->has('markPerQuestion'))
                <div class="invalid-feedback">{{ $errors->first('markPerQuestion') }}</div>
              @endif
            </div>

              <div class="col-md-4">
              <label class="form-label">Negative Marking</label>
              <select class="form-select mb-3" name="negativeMarking" id="negativeMarking" aria-label="Default select example">
                 <option selected="" value="0" >Select </option>
                <option value="25"  {{ $arrdata['negativeMarking'] == 25 ? "selected" : "" }}>25% </option>
                <option value="50"  {{ $arrdata['negativeMarking'] == 50 ? "selected" : "" }}>50% </option>
                <option value="75"  {{ $arrdata['negativeMarking'] == 75 ? "selected" : "" }}>75% </option>
                <option value="100" {{ $arrdata['negativeMarking'] == 100 ? "selected" : "" }}>100% </option>
              </select>

               <div class="invalid-feedback" id="err_negativeMarking"></div>
              @if($errors->has('negativeMarking'))
                <div class="invalid-feedback">{{ $errors->first('negativeMarking') }}</div>
              @endif
            </div>


             <div class="col-md-4">
              <label class="form-label">Question Selection</label>
                <select class="form-select mb-3" name="questionSelection" id="questionSelection" onchange="getQuestion()"  aria-label="Default select example">
                  <option value="Auto" {{ $arrdata['questionSelection'] == 'Auto' ? "selected" : "" }}>Auto</option>
                  <option value="Manual" {{ $arrdata['questionSelection'] == 'Manual' ? "selected" : "" }}>Manual</option>
                </select>
                 <div class="invalid-feedback" id="err_questionSelection"></div>
                @if($errors->has('status'))
                  <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                @endif
            </div>

              <div class="col-md-4">
              <label class="form-label">Standard</label>
                <select class="form-select mb-3" name="standard" id="sel_standard" >
                  <option selected="" value="">Select Standard</option>
                  @foreach($arrStandard as $standard)
                  <option value="{{$standard['standardID']}}" @if($standard['standardID']==$arrdata['standardID']) selected="" @endif>{{$standard['standardName']}}</option>
                  @endforeach
                </select>
                 <div class="invalid-feedback" id="err_standard"></div>
                @if($errors->has('standardID'))
                  <div class="invalid-feedback">{{ $errors->first('standardID') }}</div>
                @endif
            </div>



            <div class="col-md-4">
              <label class="form-label">Subject</label>
                <select class="form-select mb-3" id='subject_list' name="subject" >
                  <option  value="">Select subject </option>
                </select>
                 <div class="invalid-feedback" id="err_subject"></div>
                @if($errors->has('subject'))
                  <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
                @endif
            </div>

             <div class="col-md-4">
              <label class="form-label">Chapter</label>
                <select class="form-select mb-3" id="chapter_list" name="chapter" >
                  <option  value="">Select Chapter </option>
                 
                </select>
                <div class="invalid-feedback" id="err_chapter"></div>
                @if($errors->has('chapter'))
                  <div class="invalid-feedback">{{ $errors->first('chapter') }}</div>
                @endif
            </div>


              <div class="col-md-4">
              <label class="form-label">Topic</label>
                <select class="form-select mb-3" name="topic" id="topic_list" onchange="getQuestion()" aria-label="Default select example">
                  <option selected="" value="">Select Topic </option>
                </select>
                 <div class="invalid-feedback" id="err_topic"></div>
                @if($errors->has('topic'))
                  <div class="invalid-feedback">{{ $errors->first('topic') }}</div>
                @endif
            </div>
            
             <div class="col-md-4">
              <label class="form-label">Question Type</label> {{$arrdata['questionType']}}
                <select class="form-select mb-3" name="questionType" id="questionType" aria-label="Default select example">
                  <option selected="" value="1" @if($arrdata['questionType']==1) selected="" @endif>With Options </option>
                   <option  value="2" @if($arrdata['questionType']==2) selected="" @endif>No Options </option>
                </select>
                <div class="invalid-feedback" id="err_questionType"></div>
            </div>
            
            <div class="col-md-4">
              <label class="form-label">Status</label>
                <select class="form-select mb-3" name="status" aria-label="Default select example">
                  <option value="1" @if($arrdata['status']==1) selected="" @endif>Active</option>
                  <option value="0" @if($arrdata['status']==0) selected="" @endif>In-Active</option>
                </select>
                <div class="invalid-feedback" id="err_status"></div>
                @if($errors->has('status'))
                  <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                @endif
            </div>
            @if(isset($arrdata['arrQuestion']) && $arrdata['questionSelection'] == 'Manual')
            <div class="table-responsive" id="questionTableDiv">
              <table id="DataTable" class="table table-striped table-bordered data-table" style="width:100%">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" name="mult_change" id="check-all" value="delete" />
                    </th>
                    <th>Code</th>
                    <th>Question</th>
                  </tr>
                </thead>
                 <tbody id="tbody">
                  @foreach ($arrdata['arrQuestion'] as $key => $row)
                    <tr>
                      <td> 
                        @if(in_array($row->questionID,$arrdata->arrQuestionId))
                        <input type="checkbox" name="checked_questionIds[]" checked="" class="checked_questionIds" value="{{ $row->examId }}" />
                        @else
                        <input type="checkbox" name="checked_questionIds[]" class="checked_questionIds" value="{{ $row->questionID }}" />
                        @endif
                      </td>
                      <td>{{$row->questionCode}}</td>
                      <td>{{strip_tags($row->question)}}</td>
                    </tr>
                  @endforeach
                 
                </tbody>
              </table>
            </div>
            @endif
            <div class="table-responsive" id="questionTableDiv" style="display: none;">
              <table id="DataTable" class="table table-striped table-bordered data-table" style="width:100%">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" name="mult_change" id="check-all" value="delete" />
                    </th>
                    <th>Code</th>
                    <th>Question</th>
                  </tr>
                </thead>
                 <tbody id="tbody">
                 
                </tbody>
              </table>
            </div>
            <div class="invalid-feedback" id="err_checked_questionIds"></div>
             <div class="invalid-feedback" id="err_checked_questionIds"></div>
            
            <div class="text-start mt-3">
              <button type="button" class="btn btn-primary px-4" onclick="validateForm()">Submit</button>
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

    function getQuestion(){
      var questionSelection = $('#questionSelection').val();
      var topicId = $("select#topic_list option:selected").attr('value');
      if (questionSelection == 'Manual') {
        $.ajax({
           headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{url('/')}}/admin/getQuestion",
            method: 'post',
            data: {topicId: topicId},
            dataType: 'json',
            success: function(response){
              $('#tbody').html(response);            }
        });
      }
    }


  $('#check-all').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
  });

  $('#questionSelection').change(function (e) {
    $('#questionTableDiv').show();
  });

    function validateForm() 
    {
      var url = "{{ url('/') }}" + "/admin/exam-question/validate";
      $.ajax({ url: url,
        type: "POST",
        data: $('form').serialize(),
        dataType: 'json',
        success: function (data) {
            $('#frmSubmit').submit();
        },
        error: function (error) {
           var data = $.parseJSON(error.responseText);
          $.each(data.errors, function (key, value) {
            $('#err_' + key).html(value);
          });
        }
    });
  }

    $(document).ready(function(){
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
                      url:"{{url('/')}}/admin/getSubject",
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
                        url:"{{url('/')}}/admin/getChapter",
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
                        url:"{{url('/')}}/admin/getTopic",
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
    });
  </script>
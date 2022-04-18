 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"> Sub Course</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
         <!--  <ol class="breadcrumb mb-0 p-0 align-items-center">
            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li> -->
            <span class="breadcrumb-item active" aria-current="page">List</span>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{url('/')}}/admin/sub-course/create" type="button" class="btn btn-outline-primary"> <ion-icon name='add'></ion-icon>Add </a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
      @if (session('success'))
       <div class="alert alert-dismissible fade show py-2 bg-success">
          <div class="d-flex align-items-center">
            <div class="fs-3 text-white"><ion-icon name="checkmark-circle-sharp" role="img" class="md hydrated" aria-label="checkmark circle sharp"></ion-icon>
            </div>
            <div class="ms-3">
              <div class="text-white">{{session('success')}}</div>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       @endif
    <hr/>
    <div class="card">

      <div class="card-body">
      <div class="table-responsive">
        <table id="DataTable" class="table table-striped table-bordered data-table" style="width:100%">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Course</th>
              <th>Sub Course</th>
              <th>Action</th>
            </tr>
          </thead>
           <!-- <tbody>
            @foreach ($arrdata as $key => $row)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$row->courseCode}}</td>
              <td>{{$row->courseTitle}}</td>
              <td>
                <div class="d-flex align-items-center gap-3 fs-6">
                  <a href="{{url('/')}}/admin/course/edit/{{base64_encode($row->courseID)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="" data-bs-original-title="Edit info" aria-label="Edit">
                  <ion-icon name="pencil-sharp"></ion-icon>
                  </a>
                  <a href="{{url('/')}}/admin/course/delete/{{base64_encode($row->courseID)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="" data-bs-original-title="Delete" aria-label="Delete">
                  <ion-icon name="trash-sharp"></ion-icon>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody> -->
        </table>
         <!-- <div class="d-flex">
                {!! $arrdata->links() !!}
       </div> -->
      </div>
      </div>
    </div>
  </div>
  <!-- end page content-->
</div>
 <script type="text/javascript">
    
    var keyword   = $('#keyword').val();
    var temp_url    = '<?php echo url("/");?>/admin/sub-course/get_records';

    table_module    = $('#DataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "paging": true,
        "searching":true,
        "ordering": true,
        "destroy": true,
        ajax: 
        {
          'url'   : temp_url,
          type: 'post',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          'data' : {'keyword':keyword}
        },
       "columnDefs": [
          { orderable: false, targets: [ 0,3] }
        ]     
    });
</script>
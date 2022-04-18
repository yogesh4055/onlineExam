 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Tables</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Gallary</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{url('/')}}/admin/gallery/create" type="button" class="btn btn-outline-primary"> Add </a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Gallary list</h6>
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
        <table id="newsTable" class="table table-striped table-bordered data-table" style="width:100%">
          <thead class="table-light">
            <tr>
              <th>S.no</th>
              <th>Title</th>
              <th>Category</th>
              <th>Industry</th>
              <th>meta_keywords</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($arrdata as $key => $row)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$row->title}}</td>
              <td>{{$row->get_category_name->name}}</td>
              <td>{{$row->get_industry_name->name}}</td>
              <td>{{$row->meta_keywords}}</td>
              <td>{{$row->created_at }}</td>
              <td>
                @if($row->status == 1)
                <span class="badge alert-success">Published</span>
                @else
                <span class="badge alert-danger">Unpublished</span>
                @endif
              </td>
              <td>
                <div class="d-flex align-items-center gap-3 fs-6">
                  <a href="{{url('/')}}/admin/gallery/view/{{base64_encode($row->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="" data-bs-original-title="View detail" aria-label="Views">
                    <ion-icon name="eye-sharp"></ion-icon>
                  </a>
                  <a href="{{url('/')}}/admin/gallery/edit/{{base64_encode($row->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="" data-bs-original-title="Edit info" aria-label="Edit">
                    <ion-icon name="pencil-sharp"></ion-icon>
                  </a>
                  <a href="{{url('/')}}/admin/gallery/delete/{{base64_encode($row->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="" data-bs-original-title="Delete" aria-label="Delete">
                    <ion-icon name="trash-sharp"></ion-icon>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-12 col-md-12">
             {{ $arrdata->links('admin.pagination.custom') }}
          </div>
        </div>
       
      </div>
      </div>
    </div>
  </div>
  <!-- end page content-->
</div>
